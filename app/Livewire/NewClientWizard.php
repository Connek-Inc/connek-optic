<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Material;

class NewClientWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $totalSteps = 9;

    // Collections from DB
    public $dbPromotions;
    public $dbLensMaterials;
    public $dbFrameTypes;
    public $dbLensIndexes;
    public $dbLensOptions;

    // Selections
    public $clientType = null;
    public $promotionId = null;
    public $selectedPromotion = null;

    // Step 4: Prescription
    public $prescriptionType = null;
    public $photo;
    public $prescriptionPhoto;
    public $analyzing = false;
    public $prescriptionData = [
        'sph_od' => null,
        'cyl_od' => null,
        'axis_od' => null,
        'add_od' => null,
        'sph_og' => null,
        'cyl_og' => null,
        'axis_og' => null,
        'add_og' => null,
        'pd' => null,
    ];

    // Manual Entry Fields
    public $manual_sph_od, $manual_cyl_od, $manual_axis_od, $manual_add_od;
    public $manual_sph_og, $manual_cyl_og, $manual_axis_og, $manual_add_og;
    public $manual_pd;

    // Step 5: Options
    public $lensMaterialId = null;
    public $frameTypeId = null;

    // Step 6: Analysis
    public $thicknessAnalysis = 'moyen';

    // Step 7: Recommendation
    public $recommendedIndex = '1.60';

    // Step 8: Lens Configuration
    public $lensA_index = '1.60';
    public $lensA_options = [];
    public $lensB_options = [];

    // Step 9: Checkout / Summary
    public $name = '';
    public $email = '';
    public $phone = '';
    public $selectedWarranties = [];

    public function mount()
    {
        $this->dbPromotions = \App\Models\Promotion::where('active', true)->get();

        // Fallback for demo if DB is empty - optional, but good for dev
        if ($this->dbPromotions->isEmpty()) {
            $this->dbPromotions = collect([]);
        }

        $this->dbLensMaterials = Material::where('type', 'material_lens')->get();
        $this->dbFrameTypes = Material::where('type', 'frame_type')->get();

        if ($this->dbLensMaterials->isEmpty()) {
            $this->dbLensMaterials = collect([
                (object) ['id' => 1, 'name' => 'Organique CR39', 'description' => 'Standard', 'price' => 0],
                (object) ['id' => 2, 'name' => 'Polycarbonate', 'description' => 'Résistant', 'price' => 30],
            ]);
        }
        if ($this->dbFrameTypes->isEmpty()) {
            $this->dbFrameTypes = collect([
                (object) ['id' => 1, 'name' => 'Complète', 'description' => 'Métal/Acétate', 'price' => 0],
                (object) ['id' => 2, 'name' => 'Nylor', 'description' => 'Fil nylon', 'price' => 20],
                (object) ['id' => 3, 'name' => 'Percée', 'description' => 'Sans monture', 'price' => 50],
            ]);
        }

        $this->dbLensIndexes = Material::where('type', 'lens_index')->get();
        if ($this->dbLensIndexes->isEmpty()) {
            $this->dbLensIndexes = collect([
                (object) ['id' => 1, 'name' => '1.50', 'price' => 0],
                (object) ['id' => 2, 'name' => '1.60', 'price' => 50],
                (object) ['id' => 3, 'name' => '1.67', 'price' => 100],
                (object) ['id' => 4, 'name' => '1.74', 'price' => 150],
            ]);
        }
        $this->dbLensOptions = Material::where('type', 'lens_option')->get();
        if ($this->dbLensOptions->isEmpty()) {
            $this->dbLensOptions = collect([
                (object) ['id' => 1, 'name' => 'Antireflet', 'price' => 20],
                (object) ['id' => 2, 'name' => 'BlueControl', 'price' => 40],
                (object) ['id' => 3, 'name' => 'Photochromique', 'price' => 80],
            ]);
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.new-client-wizard');
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'name' => 'required|string|min:3',
                'email' => 'nullable|email',
            ]);
        }
        $this->currentStep++;
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function selectClientType($type)
    {
        $this->clientType = $type;
        $this->nextStep();
    }

    public function selectPromotion($id)
    {
        $this->promotionId = $id;
        if ($id == 0) {
            $this->selectedPromotion = null;
        } else {
            $this->selectedPromotion = $this->dbPromotions->firstWhere('id', $id);
        }
        $this->nextStep();
    }

    public function setPrescriptionType($type)
    {
        $this->prescriptionType = $type;
    }

    public function selectMaterial($id)
    {
        $this->lensMaterialId = $id;
    }

    public function selectFrameType($id)
    {
        $this->frameTypeId = $id;
    }

    public function toggleOption($lens, $optionId)
    {
        if ($lens === 'A') {
            if (in_array($optionId, $this->lensA_options)) {
                $this->lensA_options = array_diff($this->lensA_options, [$optionId]);
            } else {
                $this->lensA_options[] = $optionId;
            }
        } else {
            if (in_array($optionId, $this->lensB_options)) {
                $this->lensB_options = array_diff($this->lensB_options, [$optionId]);
            } else {
                $this->lensB_options[] = $optionId;
            }
        }
    }

    public function isOptionSelected($lens, $optionId)
    {
        if ($lens === 'A')
            return in_array($optionId, $this->lensA_options);
        return in_array($optionId, $this->lensB_options);
    }

    public function selectIndex($indexName)
    {
        $this->lensA_index = $indexName;
    }

    public function getWarrantiesProperty()
    {
        return collect([
            ['id' => 'w1', 'name' => 'Garantie Casse (1 an)', 'price' => 25],
            ['id' => 'w2', 'name' => 'Assurance Perte', 'price' => 40],
            ['id' => 'w3', 'name' => 'Entretien à vie', 'price' => 15],
        ]);
    }

    public function toggleWarranty($id)
    {
        if (in_array($id, $this->selectedWarranties)) {
            $this->selectedWarranties = array_diff($this->selectedWarranties, [$id]);
        } else {
            $this->selectedWarranties[] = $id;
        }
    }

    public function calculateTotal()
    {
        $base = $this->selectedPromotion ? $this->selectedPromotion->price : 0;
        $optionsA = 0;
        $optionsB = 0;

        $indexModel = $this->dbLensIndexes->where('name', $this->lensA_index)->first();
        if ($indexModel)
            $optionsA += $indexModel->price;

        foreach ($this->lensA_options as $optId) {
            $opt = $this->dbLensOptions->firstWhere('id', $optId);
            if ($opt)
                $optionsA += $opt->price;
        }

        foreach ($this->lensB_options as $optId) {
            $opt = $this->dbLensOptions->firstWhere('id', $optId);
            if ($opt)
                $optionsB += $opt->price;
        }

        return $base + $optionsA + $optionsB + $this->calculateWarranties();
    }

    public function calculateWarranties()
    {
        $total = 0;
        foreach ($this->selectedWarranties as $wId) {
            $w = $this->warranties->firstWhere('id', $wId);
            if ($w)
                $total += $w['price'];
        }
        return $total;
    }

    public function updatedPhoto()
    {
        $this->analyzing = true;
        sleep(2);

        $this->prescriptionData = [
            'sph_od' => '-2.25',
            'cyl_od' => '-2.75',
            'axis_od' => '90',
            'add_od' => null,
            'sph_og' => '-1.75',
            'cyl_og' => '-2.00',
            'axis_og' => '90',
            'add_og' => null,
            'pd' => '65.0',
        ];

        $this->processManualPrescription(true);
    }

    public function reserveWithoutExam()
    {
        $this->prescriptionType = 'pending';
        $this->currentStep = 8;
    }

    public function processManualPrescription($isSimulation = false)
    {
        if (!$isSimulation) {
            $this->analyzing = true;
            $this->prescriptionData = [
                'sph_od' => $this->manual_sph_od,
                'cyl_od' => $this->manual_cyl_od,
                'axis_od' => $this->manual_axis_od,
                'add_od' => $this->manual_add_od,
                'sph_og' => $this->manual_sph_og,
                'cyl_og' => $this->manual_cyl_og,
                'axis_og' => $this->manual_axis_og,
                'add_og' => $this->manual_add_og,
                'pd' => $this->manual_pd,
            ];
            sleep(1);
        }

        $maxDiopter = 0;
        $od = abs((float) $this->prescriptionData['sph_od']) + abs((float) $this->prescriptionData['cyl_od']);
        $og = abs((float) $this->prescriptionData['sph_og']) + abs((float) $this->prescriptionData['cyl_og']);
        $maxDiopter = max($od, $og);

        if ($maxDiopter < 2.0) {
            $this->recommendedIndex = '1.50';
            $this->thicknessAnalysis = 'Low';
        } elseif ($maxDiopter < 4.0) {
            $this->recommendedIndex = '1.60';
            $this->thicknessAnalysis = 'Medium';
        } elseif ($maxDiopter < 6.0) {
            $this->recommendedIndex = '1.67';
            $this->thicknessAnalysis = 'High';
        } else {
            $this->recommendedIndex = '1.74';
            $this->thicknessAnalysis = 'Very High';
        }

        $this->lensA_index = $this->recommendedIndex;

        $this->analyzing = false;
        if (!$isSimulation)
            $this->nextStep();
    }

    public function saveSale()
    {
        // Validation already happened at Step 1
        $client = Client::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'prescription_details' => json_encode($this->prescriptionData),
        ]);

        Sale::create([
            'client_id' => $client->id,
            'total_amount' => $this->calculateTotal(),
            'status' => 'completed',
            'details' => [
                'type' => $this->clientType,
                'promo' => $this->selectedPromotion ? $this->selectedPromotion->name : 'N/A',
                'material_id' => $this->lensMaterialId,
                'frame_id' => $this->frameTypeId,
                'lens_a' => [
                    'index' => $this->lensA_index,
                    'options' => $this->lensA_options
                ],
                'lens_b' => [
                    'options' => $this->lensB_options
                ],
                'warranties' => $this->selectedWarranties,
            ]
        ]);

        return redirect()->route('dashboard');
    }
}
