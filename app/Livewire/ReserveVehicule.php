<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use App\Modules\GestionUtilisateurs\Models\User;
use Illuminate\Support\Str; // For generating random password
use App\Modules\GestionVehicules\Models\Vehicule;
use Carbon\Carbon;
use Livewire\Component;
use App\Modules\GestionReservations\Models\Reservation; // Important: namespace correct
class ReserveVehicule extends Component
{
    // --- Step 1: Vehicule Selection (already selected via route model binding) ---
    #[Layout("components.layouts.guest")]
    public Vehicule $selectedVehicule; // Renamed from $vehicule to match Blade
    public $pickupDateTime;
    public $returnDateTime;

    // --- Step 2: Rental Details (Insurance & Add-ons) ---
    public $selectedInsurance = "basic"; // Default to basic
    public $selectedAddons = []; // Array of selected add-on keys

    // Define add-on prices
    protected $addonPrices = [
        "gps" => 8,
        "child_seat" => 10,
        "wifi" => 6,
        "additional_driver" => 15,
    ];

    // Define insurance prices (per day, beyond basic)
    protected $insurancePrices = [
        "premium" => 12,
        "comprehensive" => 25,
    ];

    // --- Step 3: Driver Information ---
    public $driverInfo = [
        "first_name" => "",
        "last_name" => "",
        "email" => "",
        "phone" => "",
        "date_of_birth" => "",
        "license_number" => "",
        "license_expiry" => "",
        "address" => "",
        "city" => "",
        "state" => "",
        "zip_code" => "",
        "cin" => "",
    ];

    public $additionalDriverInfo = [
        "first_name" => "",
        "last_name" => "",
        "date_of_birth" => "",
        "license_number" => "",
    ];

    // --- Step 4: Payment ---
    public $paymentMethod = "credit_card"; // Default payment method
    public $cardInfo = [
        "number" => "",
        "name" => "",
        "expiry" => "",
        "cvv" => "",
    ];
    public $sameAsDriverAddress = true;
    public $billingInfo = [
        "address" => "",
        "city" => "",
        "state" => "",
        "zip_code" => "",
    ];

    // --- Step 5: Confirmation (Output) ---
    public $confirmationNumber;
    public $finalTotalPrice; // To store the actual total price after calculations

    // Multi-step logic
    public $currentStep = 1;

    // --- Computed Properties for calculations and display ---

    // Total rental days
    public function getTotalDaysProperty()
    {
        if ($this->pickupDateTime && $this->returnDateTime) {
            try {
                $start = Carbon::parse($this->pickupDateTime);
                $end = Carbon::parse($this->returnDateTime);
                if ($end->greaterThan($start)) {
                    $days = $end->diffInDays($start);
                    return $days > 0 ? $days : 1; // Minimum 1 day
                }
            } catch (\Exception $e) {
                // Log or handle date parsing errors
            }
        }
        return 0;
    }

    // Subtotal based on Vehicule daily rate and duration
    public function getSubtotalProperty()
    {
        return $this->selectedVehicule->tarif_journalier * $this->totalDays;
    }

    // Insurance cost
    public function getInsuranceCostProperty()
    {
        if ($this->selectedInsurance === "basic") {
            return 0;
        }
        return ($this->insurancePrices[$this->selectedInsurance] ?? 0) *
            $this->totalDays;
    }

    // Add-ons total cost
    public function getAddonCostsProperty()
    {
        $costs = [];
        foreach ($this->selectedAddons as $addon) {
            $costPerDay = $this->addonPrices[$addon] ?? 0;
            $costs[$addon] = $costPerDay * $this->totalDays;
        }
        return $costs;
    }

    public function getTotalAddonsCostProperty()
    {
        return array_sum($this->addonCosts);
    }

    // Taxes and fees (example: 10% of subtotal + insurance + addons)
    public function getTaxesAndFeesProperty()
    {
        $baseForTaxes =
            $this->subtotal + $this->insuranceCost + $this->totalAddonsCost;
        return round($baseForTaxes * 0.1, 2); // Example: 10% tax
    }

    // Discount (example: if Vehicule has a discount percentage)
    public function getDiscountAmountProperty()
    {
        return round(
            $this->subtotal *
                ($this->selectedVehicule->discount_percentage / 100),
            2
        );
    }

    // Overall total price
    public function getTotalPriceProperty()
    {
        $total =
            $this->subtotal +
            $this->insuranceCost +
            $this->totalAddonsCost +
            $this->taxesAndFees -
            $this->discountAmount;
        return max(0, round($total, 2)); // Ensure price doesn't go negative
    }

    // --- Lifecycle Hooks ---
    public function mount(Vehicule $vehicule)
    {
        $this->selectedVehicule = $vehicule;
        // Pre-fill driver info if user is authenticated
        if (auth()->check()) {
            $user = auth()->user();
            $this->driverInfo["first_name"] = $user->name; // Assuming 'name' is first name
            $this->driverInfo["email"] = $user->email;
            $this->driverInfo["cin"] = $user->cin;
            $this->driverInfo["phone"] = $user->phone;
            // You might have other profile fields to pre-fill
        }
    }

    // Called whenever a bound property is updated
    public function updated($propertyName)
    {
        // For date/time inputs, recalculate total
        if (
            in_array($propertyName, [
                "pickupDateTime",
                "returnDateTime",
                "selectedInsurance",
                "selectedAddons",
            ])
        ) {
            $this->resetValidation(); // Clear validation messages when dates change
        }

        // Automatically fill billing address if checkbox is ticked
        if ($propertyName === "sameAsDriverAddress") {
            if ($this->sameAsDriverAddress) {
                $this->billingInfo["address"] = $this->driverInfo["address"];
                $this->billingInfo["city"] = $this->driverInfo["city"];
                $this->billingInfo["state"] = $this->driverInfo["state"];
                $this->billingInfo["zip_code"] = $this->driverInfo["zip_code"];
            } else {
                $this->reset([
                    "billingInfo.address",
                    "billingInfo.city",
                    "billingInfo.state",
                    "billingInfo.zip_code",
                ]);
            }
        }
    }

    // --- Navigation Methods ---

    public function nextStep()
    {
        // Validate current step data before moving to the next
        if ($this->currentStep === 1) {
            $this->validate([
                "pickupDateTime" => "required|date|after_or_equal:today",
                "returnDateTime" => "required|date|after:pickupDateTime",
            ]);
            if ($this->totalDays <= 0) {
                $this->addError(
                    "returnDateTime",
                    "Return date must be after pickup date and time, resulting in at least 1 day rental."
                );
                return;
            }
        } elseif ($this->currentStep === 2) {
            // $this->validate([
            //     "selectedInsurance" => [
            //         "required",
            //         Rule::in(array_keys($this->insurancePrices), "basic"),
            //     ],
            // No validation needed for selectedAddons unless they have specific rules
        } elseif ($this->currentStep === 3) {
            $this->validate([
                "pickupDateTime" => "required|date|after_or_equal:today",
                "returnDateTime" => "required|date|after:pickupDateTime",
                "driverInfo.first_name" => "required|string|max:255",
                "driverInfo.last_name" => "required|string|max:255",
                "driverInfo.email" => "required|email|max:255",
                "driverInfo.phone" => "required|string|max:20",
                "driverInfo.date_of_birth" =>
                    "required|date|before_or_equal:" .
                    Carbon::now()->subYears(18)->toDateString(), // Driver must be at least 18
                "driverInfo.license_number" => "required|string|max:255",
                "driverInfo.license_expiry" =>
                    "required|date|after_or_equal:today",
                "driverInfo.address" => "required|string|max:255",
                "driverInfo.city" => "required|string|max:255",
                "driverInfo.state" => "required|string|max:255",
                "driverInfo.zip_code" => "required|string|max:10",
            ]);

            if (in_array("additional_driver", $this->selectedAddons)) {
                $this->validate([
                    "additionalDriverInfo.first_name" =>
                        "required|string|max:255",
                    "additionalDriverInfo.last_name" =>
                        "required|string|max:255",
                    "additionalDriverInfo.date_of_birth" =>
                        "required|date|before_or_equal:" .
                        Carbon::now()->subYears(18)->toDateString(),
                    "additionalDriverInfo.license_number" =>
                        "required|string|max:255",
                ]);
            }
        }

        // Only move to next step if validation passes
        $this->currentStep++;
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    // --- Final Booking Process ---

    // public function processPayment()
    // {
    //     // Validate payment info (Step 4)
    //     if ($this->paymentMethod === "credit_card") {
    //         $this->validate([
    //             "cardInfo.number" => "required|string|min:13|max:19", // Basic card number length
    //             "cardInfo.name" => "required|string|max:255",
    //             "cardInfo.expiry" =>
    //                 "required|string|date_format:m/y|after_or_equal:today", // MM/YY format
    //             "cardInfo.cvv" => "required|string|min:3|max:4",
    //         ]);
    //     }
    //     // If not sameAsDriverAddress, validate billing info
    //     if (!$this->sameAsDriverAddress) {
    //         $this->validate([
    //             "billingInfo.address" => "required|string|max:255",
    //             "billingInfo.city" => "required|string|max:255",
    //             "billingInfo.state" => "required|string|max:255",
    //             "billingInfo.zip_code" => "required|string|max:10",
    //         ]);
    //     }

    //     // If all validation passes, proceed to create reservation
    //     // This is where you'd integrate with a payment gateway (Stripe, PayPal, etc.)
    //     // For now, we'll simulate success and create the reservation record.

    //     // Simulate payment gateway processing
    //     // In a real application, you'd send cardInfo to a payment service
    //     // and handle their response.

    //     // If payment is successful:
    //     try {
    //         $this->finalTotalPrice = $this->totalPrice; // Store final calculated price

    //         // Create the reservation record with data from the form
    //         $reservation = Reservation::create([
    //         "client_id" => auth()->check() ? auth()->user()->id : 'guest-' . (Reservation::count() + 1), // Generate guest ID based on reservation count
    //             "vehicule_id" => $this->selectedVehicule->id,
    //             "date_debut_location" => Carbon::parse($this->pickupDateTime),
    //             "date_fin_location" => Carbon::parse($this->returnDateTime),
    //             "prix_total" => $this->finalTotalPrice,
    //             "notes_speciales" =>
    //                 "Insurance: " .
    //                 $this->selectedInsurance .
    //                 "; Addons: " .
    //                 implode(", ", $this->selectedAddons) .
    //                 "; Driver: " .
    //                 $this->driverInfo["first_name"] .
    //                 " " .
    //                 $this->driverInfo["last_name"] .
    //                 "; Email: " .
    //                 $this->driverInfo["email"] .
    //                 "; Phone: " .
    //                 $this->driverInfo["phone"] .
    //                 "; Payment: " .
    //                 $this->paymentMethod .
    //                 "; " .
    //                 ($this->notes_speciales ?? ""), // Store guest contact info in notes
    //             "status" => "confirme", // Or 'en_attente' if manual approval is needed
    //         ]);

    //         $this->confirmationNumber =
    //             "RES-" . str_pad($reservation->id, 6, "0", STR_PAD_LEFT);

    //         // Move to confirmation step
    //         $this->currentStep = 5;

    //         session()->flash(
    //             "message",
    //             "Booking successful! Your confirmation number is " .
    //                 $this->confirmationNumber
    //         );
    //     } catch (\Exception $e) {
    //         session()->flash("error", "Booking failed: " . $e->getMessage());
    //         // Optionally, log the error: \Log::error($e);
    //         $this->currentStep = 4; // Stay on payment step if error
    //     }
    // }
    //
    public function processPayment()
    {
        // Validate payment info (Step 4)
        if ($this->paymentMethod === "credit_card") {
            $this->validate([
                "cardInfo.number" => "required|string|min:13|max:19",
                "cardInfo.name" => "required|string|max:255",
                "cardInfo.expiry" =>
                    "required|string|date_format:m/y|after_or_equal:today",
                "cardInfo.cvv" => "required|string|min:3|max:4",
            ]);
        }
        if (!$this->sameAsDriverAddress) {
            $this->validate([
                "billingInfo.address" => "required|string|max:255",
                "billingInfo.city" => "required|string|max:255",
                "billingInfo.state" => "required|string|max:255",
                "billingInfo.zip_code" => "required|string|max:10",
            ]);
        }
        // dump($this->pickupDateTime, $this->returnDateTime);

        try {
            // --- Determine or Create Client User ---
            $clientUser = auth()->user(); // Attempt to get authenticated user

            if (!$clientUser) {
                // If not authenticated, try to find user by email or create a new one
                $clientUser = User::firstOrCreate(
                    ["email" => $this->driverInfo["email"]],
                    [
                        "name" =>
                            $this->driverInfo["first_name"] .
                            " " .
                            $this->driverInfo["last_name"],
                        "password" => bcrypt(Str::random(12)), // Generate a random password for new guest
                        "email_verified_at" => null, // Mark as unverified
                        "cin" => $this->driverInfo["cin"],
                        // Add other fields you might have on User model
                        // 'last_name' => $this->driverInfo['last_name'],
                        // 'phone' => $this->driverInfo['phone'],
                        // 'address' => $this->driverInfo['address'],
                        // 'city' => $this->driverInfo['city'],
                        // 'state' => $this->driverInfo['state'],
                        // 'zip_code' => $this->driverInfo['zip_code'],
                    ]
                );

                // If a new user was created, you might want to send them an email
                // to set a password for future logins.
            }
            // --- End Determine or Create Client User ---

            $this->finalTotalPrice = $this->totalPrice;

            dump([
                "client_id" => $clientUser->id,
                "vehicule_id" => $this->selectedVehicule->id,
                "date_debut_location_string" => $this->pickupDateTime, // The raw string from Livewire
                "date_debut_location_parsed" => Carbon::parse(
                    $this->pickupDateTime
                ), // How Carbon interprets it
                "date_fin_location_string" => $this->returnDateTime,
                "date_fin_location_parsed" => Carbon::parse(
                    $this->returnDateTime
                ),
                "prix_total" => $this->finalTotalPrice,
                "notes_speciales_data" => [
                    "insurance" => $this->selectedInsurance,
                    "addons" => $this->selectedAddons,
                    "primary_driver" => $this->driverInfo,
                    "additional_driver" => in_array(
                        "additional_driver",
                        $this->selectedAddons
                    )
                        ? $this->additionalDriverInfo
                        : null,
                    "payment_method" => $this->paymentMethod,
                ],
                "status" => "confirme",
            ]);
            $reservation = Reservation::create([
                "client_id" => $clientUser->id, // Use the ID of the determined/created user
                "vehicule_id" => $this->selectedVehicule->id,
                "date_debut_location" => Carbon::parse($this->pickupDateTime),
                "date_fin_location" => Carbon::parse($this->returnDateTime),
                "prix_total" => $this->finalTotalPrice,
                "notes_speciales" => json_encode([
                    // Store additional details as JSON
                    "insurance" => $this->selectedInsurance,
                    "addons" => $this->selectedAddons,
                    "primary_driver" => $this->driverInfo,
                    "additional_driver" => in_array(
                        "additional_driver",
                        $this->selectedAddons
                    )
                        ? $this->additionalDriverInfo
                        : null,
                    "payment_method" => $this->paymentMethod,
                    // You would NOT store cardInfo directly in DB due to PCI compliance
                    // 'billing_address' => $this->sameAsDriverAddress ? 'Same as driver' : $this->billingInfo,
                ]),
                "status" => "confirme",
            ]);

            $this->confirmationNumber =
                "RES-" . str_pad($reservation->id, 6, "0", STR_PAD_LEFT);

            $this->currentStep = 5;
            session()->flash(
                "message",
                "Booking successful! Your confirmation number is " .
                    $this->confirmationNumber
            );
        } catch (\Exception $e) {
            session()->flash("error", "Booking failed: " . $e->getMessage());
            $this->currentStep = 4; // Stay on payment step if error
        }
    }

    // Actions on Confirmation Step
    public function downloadConfirmation()
    {
        session()->flash(
            "info",
            "Downloading confirmation for " . $this->confirmationNumber . "..."
        );
        // Implement PDF generation or similar
        // return response()->download(storage_path('app/confirmations/' . $this->confirmationNumber . '.pdf'));
    }

    public function manageBooking()
    {
        session()->flash(
            "info",
            "Redirecting to manage booking for " .
                $this->confirmationNumber .
                "..."
        );
        // Redirect to a user's booking management page
        // return redirect()->route('user.bookings');
    }

    public function changeVehicule()
    {
        // Redirect back to the Vehicule list to select a different Vehicule
        return redirect()->route("vehicules.index");
    }

    public function render()
    {
        // States for billing address dropdown (example data)
        $states = [
            "AL" => "Alabama",
            "AK" => "Alaska",
            "AZ" => "Arizona",
            "AR" => "Arkansas",
            "CA" => "California",
            "CO" => "Colorado",
            "CT" => "Connecticut",
            "DE" => "Delaware",
            "FL" => "Florida",
            "GA" => "Georgia",
            "HI" => "Hawaii",
            "ID" => "Idaho",
            "IL" => "Illinois",
            "IN" => "Indiana",
            "IA" => "Iowa",
            "KS" => "Kansas",
            "KY" => "Kentucky",
            "LA" => "Louisiana",
            "ME" => "Maine",
            "MD" => "Maryland",
            "MA" => "Massachusetts",
            "MI" => "Michigan",
            "MN" => "Minnesota",
            "MS" => "Mississippi",
            "MO" => "Missouri",
            "MT" => "Montana",
            "NE" => "Nebraska",
            "NV" => "Nevada",
            "NH" => "New Hampshire",
            "NJ" => "New Jersey",
            "NM" => "New Mexico",
            "NY" => "New York",
            "NC" => "North Carolina",
            "ND" => "North Dakota",
            "OH" => "Ohio",
            "OK" => "Oklahoma",
            "OR" => "Oregon",
            "PA" => "Pennsylvania",
            "RI" => "Rhode Island",
            "SC" => "South Carolina",
            "SD" => "South Dakota",
            "TN" => "Tennessee",
            "TX" => "Texas",
            "UT" => "Utah",
            "VT" => "Vermont",
            "VA" => "Virginia",
            "WA" => "Washington",
            "WV" => "West Virginia",
            "WI" => "Wisconsin",
            "WY" => "Wyoming",
        ];

        return view("livewire.reserve-vehicule", [
            "states" => $states,
        ]);
    }
}
