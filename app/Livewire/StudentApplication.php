<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentApplication extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $other_names;
    public $email;
    public $phone;
    public $gender;
    public $religion;
    public $dob;
    public $nin;
    public $current_residence_address;
    public $permanent_residence_address;
    public $guardian_name;
    public $guardian_phone_number;
    public $guardian_address;
    public $secondary_school_attended;
    public $secondary_school_graduation_year;
    public $secondary_school_certificate_type;
    public $jamb_reg_no;
    public $jamb_score;
    public $department_id;
    public $document_medical_report;
    public $document_birth_certificate;
    public $document_local_government_identification;
    public $document_secondary_school_certificate_type;
    public $passport_photo;
    public $terms;






    public $country;
    public $state;
    public $localGovernment;
    public $states = [];
    public $localGovernments = [];



    public $sittings = 1;
    public $examBoard1 = 'waec';
    public $examBoard2 = 'waec';
    public $subjects1 = [];
    public $subjects2 = [];
    public $showSecondSitting = false;


    protected $rules = [
        'country' => 'required',
        'state' => 'required_if:country,Nigeria',
        'localGovernment' => 'required_if:country,Nigeria',


        'sittings' => 'required|integer|in:1,2',
        'examBoard1' => 'required_if:sittings,1|in:waec,neco,gce',
        'examBoard2' => 'required_if:sittings,2|in:waec,neco,gce',
        'subjects1.*.subject' => 'required_with:subjects1|distinct|min:8',
        'subjects1.*.score' => 'required_with:subjects1|numeric|between:0,100',
        'subjects2.*.subject' => 'required_with:subjects2|distinct|min:8',
        'subjects2.*.score' => 'required_with:subjects2|numeric|between:0,100',

    ];

    public function mount()
    {
        $user = User::with('student')->find(auth()->user()->id);

        $this->first_name = old('first_name') ?? ($user ? $user->first_name : null);

        $this->last_name = old('last_name') ?? ($user ? $user->last_name : null);

        $this->other_names = old('other_names') ?? ($user ? $user->other_names : null);

        $this->email = old('email') ?? ($user ? $user->email : null);

        $this->phone = old('phone') ?? ($user->student ? $user->student->phone : null);
        
        $this->religion = old('religion') ?? ($user->student ? $user->student->religion : null);

        $this->dob = old('dob') ?? ($user->student ? $user->student->dob : null);

        $this->nin = old('nin') ?? ($user->student ? $user->student->nin : null);

        $this->current_residence_address = old('current_residence_address') ?? ($user->student ? $user->student->current_residence_address : null);

        $this->permanent_residence_address = old('permanent_residence_address') ?? ($user->student ? $user->student->permanent_residence_address : null);

        $this->guardian_name = old('guardian_name') ?? ($user->student ? $user->student->guardian_name : null);

        $this->guardian_phone_number = old('guardian_phone_number') ?? ($user->student ? $user->student->guardian_phone_number : null);

        $this->guardian_address = old('guardian_address') ?? ($user->student ? $user->student->guardian_address : null);

        $this->secondary_school_attended = old('secondary_school_attended') ?? ($user->student ? $user->student->secondary_school_attended : null);

        $this->secondary_school_graduation_year = old('secondary_school_graduation_year') ?? ($user->student ? $user->student->secondary_school_graduation_year : null);

        $this->secondary_school_certificate_type = old('secondary_school_certificate_type') ?? ($user->student ? $user->student->secondary_school_certificate_type : null);

        $this->jamb_reg_no = old('jamb_reg_no') ?? ($user->student ? $user->student->jamb_reg_no : null);

        $this->jamb_score = old('jamb_score') ?? ($user->student ? $user->student->jamb_score : null);

        $this->department_id = old('department_id') ?? ($user->student ? $user->student->department_id : null);

        $this->passport_photo = old('passport_photo') ?? ($user->student ? $user->student->passport_photo : null);


        $this->document_birth_certificate = old('document_birth_certificate') ?? ($user->student ? $user->student->document_birth_certificate : null);
        $this->document_local_government_identification = old('document_local_government_identification') ?? ($user->student ? $user->student->document_local_government_identification : null);
        $this->document_secondary_school_certificate_type = old('document_secondary_school_certificate_type') ?? ($user->student ? $user->student->document_secondary_school_certificate_type : null);


        if (old('gender')) {
            $this->gender = old('gender');
        } elseif ($user->student) {
            $this->gender = $user->student->gender;
        }
        $this->religion = $user->student->religion;
    }

    public function render()
    {
        $departments = Department::all();
        return view('livewire.student-application', ['departments' => $departments]);
    }

    public function updatedSittings($value)
    {
        $this->showSecondSitting = $value === 2;

        if ($value === 1) {
            $this->subjects2 = [];
        } elseif ($value === 2) {
            $this->subjects1 = [];
        }
    }


    public function addSubject($index)
    {
        if ($index === 1) {
            $this->subjects1[] = ['subject' => '', 'score' => ''];
        } elseif ($index === 2) {
            $this->subjects2[] = ['subject' => '', 'score' => ''];
        }
    }

    public function removeSubject($index, $key)
    {
        if ($index === 1) {
            unset($this->subjects1[$key]);
            $this->subjects1 = array_values($this->subjects1);
        } elseif ($index === 2) {
            unset($this->subjects2[$key]);
            $this->subjects2 = array_values($this->subjects2);
        }
    }













    public function updatedCountry($value)
    {
        $this->resetStateAndLocalGovernment();

        if ($value === 'Nigeria') {
            $this->states = $this->getNigerianStates();
        }
    }



    public function updatedState($value)
    {
        if (!empty($value)) {
            $this->localGovernments = $this->getLocalGovernmentsByState($value);
        } else {
            $this->localGovernments = [];
        }
    }


    protected function resetStateAndLocalGovernment()
    {
        $this->state = null;
        $this->localGovernment = null;
        $this->states = [];
        $this->localGovernments = [];
    }

    protected function getNigerianStates()
    {
        // Return an array of Nigerian states
        return [
            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara',
        ];
    }

    protected function getLocalGovernmentsByState($state)
    {
        $localGovernments = [
            'Abia' => ['Aba North', 'Aba South', 'Arochukwu', 'Bende', 'Ikwuano', 'Isiala Ngwa North', 'Isiala Ngwa South', 'Isuikwuato', 'Obi Ngwa', 'Ohafia', 'Osisioma', 'Ugwunagbo', 'Ukwa East', 'Ukwa West', 'Umuahia North', 'Umuahia South', 'Umu Nneochi'],


            'Adamawa' => ['Demsa', 'Fufure', 'Ganye', 'Girei', 'Gombi', 'Guyuk', 'Hong', 'Jada', 'Lamurde', 'Madagali', 'Maiha', 'Mayo Belwa', 'Michika', 'Mubi North', 'Mubi South', 'Numan', 'Shelleng', 'Song', 'Toungo', 'Yola North', 'Yola South'],

            'Akwa Ibom' => ['Abak', 'Eastern Obolo', 'Eket', 'Esit Eket', 'Essien Udim', 'Etim Ekpo', 'Etinan', 'Ibeno', 'Ibesikpo Asutan', 'Ibiono Ibom', 'Ika', 'Ikono', 'Ikot Abasi', 'Ikot Ekpene', 'Ini', 'Itu', 'Mbo', 'Mkpat Enin', 'Nsit Atai', 'Nsit Ibom', 'Nsit Ubium', 'Obot Akara', 'Okobo', 'Onna', 'Oron', 'Oruk Anam', 'Udung Uko', 'Ukanafun', 'Uruan', 'Urue-Offong/Oruko', 'Uyo'],


            'Anambra' => ['Aguata', 'Anambra East', 'Anambra West', 'Anaocha', 'Awka North', 'Awka South', 'Ayamelum', 'Dunukofia', 'Ekwusigo', 'Idemili North', 'Idemili South', 'Ihiala', 'Njikoka', 'Nnewi North', 'Nnewi South', 'Ogbaru', 'Onitsha North', 'Onitsha South', 'Orumba North', 'Orumba South', 'Oyi'],


            'Bauchi' => ['Alkaleri', 'Bauchi', 'Bogoro', 'Damban', 'Darazo', 'Dass', 'Gamawa', 'Ganjuwa', 'Giade', 'Itas/Gadau', 'Jama’are', 'Katagum', 'Kirfi', 'Misau', 'Ningi', 'Shira', 'Tafawa Balewa', 'Toro', 'Warji', 'Zaki'],


            'Bayelsa' => ['Brass', 'Ekeremor', 'Kolokuma/Opokuma', 'Nembe', 'Ogbia', 'Sagbama', 'Southern Ijaw', 'Yenagoa'],


            'Benue' => ['Ado', 'Agatu', 'Apa', 'Buruku', 'Gboko', 'Guma', 'Gwer East', 'Gwer West', 'Katsina-Ala', 'Konshisha', 'Kwande', 'Logo', 'Makurdi', 'Obi', 'Ogbadibo', 'Ohimini', 'Oju', 'Okpokwu', 'Otukpo', 'Tarka', 'Ukum', 'Ushongo', 'Vandeikya'],


            'Borno' => ['Abadam', 'Askira/Uba', 'Bama', 'Bayo', 'Biase', 'Chibok', 'Damboa', 'Dikwa', 'Gubio', 'Guzamala', 'Gwoza', 'Hawul', 'Jere', 'Kaga', 'Kala/Balge', 'Konduga', 'Kukawa', 'Kwaya Kusar', 'Mafa', 'Magumeri', 'Maiduguri', 'Marte', 'Mobbar', 'Monguno', 'Ngala', 'Nganzai', 'Shani'],


            'Cross River' => ['Abi', 'Akamkpa', 'Akpabuyo', 'Bakassi', 'Bekwarra', 'Biase', 'Boki', 'Calabar Municipal', 'Calabar South', 'Etung', 'Ikom', 'Obanliku', 'Obubra', 'Obudu', 'Odukpani', 'Ogoja', 'Yakurr', 'Yala'],


            'Delta' => ['Aniocha North', 'Aniocha South', 'Bomadi', 'Burutu', 'Ethiope East', 'Ethiope West', 'Ika North East', 'Ika South', 'Isoko North', 'Isoko South', 'Ndokwa East', 'Ndokwa West', 'Okpe', 'Oshimili North', 'Oshimili South', 'Patani', 'Sapele', 'Udu', 'Ughelli North', 'Ughelli South', 'Ukwuani', 'Uvwie', 'Warri North', 'Warri South', 'Warri South West'],


            'Ebonyi' => ['Abakaliki', 'Afikpo North', 'Afikpo South', 'Ebonyi', 'Ezza North', 'Ezza South', 'Ikwo', 'Ishielu', 'Ivo', 'Izzi', 'Ohaozara', 'Ohaukwu', 'Onicha'],


            'Edo' => ['Akoko-Edo', 'Egor', 'Esan Central', 'Esan North-East', 'Esan South-East', 'Esan West', 'Etsako Central', 'Etsako East', 'Etsako West', 'Igueben', 'Ikpoba Okha', 'Orhionmwon', 'Oredo', 'Ovia North-East', 'Ovia South-West', 'Owan East', 'Owan West', 'Uhunmwonde'],

            'Ekiti' => ['Ado Ekiti', 'Efon', 'Ekiti East', 'Ekiti South-West', 'Ekiti West', 'Emure', 'Gbonyin', 'Ido Osi', 'Ijero', 'Ikere', 'Ikole', 'Ilejemeje', 'Irepodun/Ifelodun', 'Ise/Orun', 'Moba', 'Oye'],

            'Enugu' => ['Aninri', 'Awgu', 'Enugu East', 'Enugu North', 'Enugu South', 'Ezeagu', 'Igbo Etiti', 'Igbo Eze North', 'Igbo Eze South', 'Isi Uzo', 'Nkanu East', 'Nkanu West', 'Nsukka', 'Oji River', 'Udenu', 'Udi', 'Uzo Uwani'],


            'Gombe' => ['Akko', 'Balanga', 'Billiri', 'Dukku', 'Funakaye', 'Gombe', 'Kaltungo', 'Kwami', 'Nafada', 'Shongom', 'Yamaltu/Deba'],

            'Imo' => ['Aboh Mbaise', 'Ahiazu Mbaise', 'Ehime Mbano', 'Ezinihitte Mbaise', 'Ideato North', 'Ideato South', 'Ihitte/Uboma', 'Ikeduru', 'Isiala Mbano', 'Isu', 'Mbaitoli', 'Ngor Okpala', 'Njaba', 'Nkwerre', 'Nwangele', 'Obowo', 'Oguta', 'Ohaji/Egbema', 'Okigwe', 'Orlu', 'Orsu', 'Oru East', 'Oru West', 'Owerri Municipal', 'Owerri North', 'Owerri West', 'Unuimo'],


            'Jigawa' => ['Auyo', 'Babura', 'Biriniwa', 'Birnin Kudu', 'Buji', 'Dutse', 'Gagarawa', 'Garki', 'Gumel', 'Guri', 'Gwaram', 'Gwiwa', 'Hadejia', 'Jahun', 'Kafin Hausa', 'Kaugama', 'Kazaure', 'Kiri Kasama', 'Kiyawa', 'Maigatari', 'Malam Madori', 'Miga', 'Ringim', 'Roni', 'Sule Tankarkar', 'Taura', 'Yankwashi'],


            'Kaduna' => ['Birnin Gwari', 'Chikun', 'Giwa', 'Igabi', 'Ikara', 'Jaba', 'Jema’a', 'Kachia', 'Kaduna North', 'Kaduna South', 'Kagarko', 'Kajuru', 'Kaura', 'Kauru', 'Kubau', 'Kudan', 'Lere', 'Makarfi', 'Sabon Gari', 'Sanga', 'Soba', 'Zangon Kataf', 'Zaria'],


            'Kano' => ['Ajingi', 'Albasu', 'Bagwai', 'Bebeji', 'Bichi', 'Bunkure', 'Dala', 'Dambatta', 'Dawakin Kudu', 'Dawakin Tofa', 'Doguwa', 'Fagge', 'Gabasawa', 'Garko', 'Garun Mallam', 'Gaya', 'Gezawa', 'Gwale', 'Gwarzo', 'Kabo', 'Kano Municipal', 'Karaye', 'Kibiya', 'Kiru', 'Kumbotso', 'Kunchi', 'Kura', 'Madobi', 'Makoda', 'Minjibir', 'Nasarawa', 'Rano', 'Rimin Gado', 'Rogo', 'Shanono', 'Sumaila', 'Takai', 'Tarauni', 'Tofa', 'Tsanyawa', 'Tudun Wada', 'Ungogo', 'Warawa', 'Wudil'],


            'Katsina' => ['Bakori', 'Batagarawa', 'Batsari', 'Baure', 'Bindawa', 'Charanchi', 'Dan Musa', 'Dandume', 'Danja', 'Daura', 'Dutsi', 'Dutsin Ma', 'Faskari', 'Funtua', 'Ingawa', 'Jibia', 'Kafur', 'Kaita', 'Kankara', 'Kankia', 'Katsina', 'Kurfi', 'Kusada', 'Mai’Adua', 'Malumfashi', 'Mani', 'Mashi', 'Matazu', 'Musawa', 'Rimi', 'Sabuwa', 'Safana', 'Sandamu', 'Zango'],


            'Kebbi' => ['Aleiro', 'Arewa Dandi', 'Argungu', 'Augie', 'Bagudo', 'Birnin Kebbi', 'Bunza', 'Dandi', 'Fakai', 'Gwandu', 'Jega', 'Kalgo', 'Koko/Besse', 'Maiyama', 'Ngaski', 'Sakaba', 'Shanga', 'Suru', 'Wasagu/Danko', 'Yauri', 'Zuru'],


            'Kogi' => ['Adavi', 'Ajaokuta', 'Ankpa', 'Bassa', 'Dekina', 'Ibaji', 'Idah', 'Igalamela Odolu', 'Ijumu', 'Ikole', 'Kabba/Bunu', 'Kogi', 'Lokoja', 'Mopa Muro', 'Ofu', 'Ogori/Magongo', 'Okehi', 'Okene', 'Olamaboro', 'Omala', 'Yagba East', 'Yagba West'],


            'Kwara' => ['Asa', 'Baruten', 'Edu', 'Ekiti', 'Ifelodun', 'Ilorin East', 'Ilorin South', 'Ilorin West', 'Irepodun', 'Isin', 'Kaiama', 'Moro', 'Offa', 'Oke Ero', 'Oyun', 'Pategi'],

            'Lagos' => ['Agege', 'Ajeromi-Ifelodun', 'Alimosho', 'Amuwo-Odofin', 'Apapa', 'Badagry', 'Epe', 'Eti Osa', 'Ibeju-Lekki', 'Ifako-Ijaiye', 'Ikeja', 'Ikorodu', 'Kosofe', 'Lagos Island', 'Lagos Mainland', 'Mushin', 'Ojo', 'Oshodi-Isolo', 'Shomolu', 'Surulere'],


            'Nasarawa' => ['Akwanga', 'Awe', 'Doma', 'Karu', 'Keana', 'Keffi', 'Kokona', 'Lafia', 'Nasarawa', 'Nasarawa Egon', 'Obi', 'Toto', 'Wamba'],


            'Niger' => ['Agaie', 'Agwara', 'Bida', 'Borgu', 'Bosso', 'Chanchaga', 'Edati', 'Gbako', 'Gurara', 'Katcha', 'Kontagora', 'Lapai', 'Lavun', 'Magama', 'Mariga', 'Mashegu', 'Mokwa', 'Munya', 'Paikoro', 'Rafi', 'Rijau', 'Shiroro', 'Suleja', 'Tafa', 'Wushishi'],


            'Ogun' => ['Abeokuta North', 'Abeokuta South', 'Ado-Odo/Ota', 'Egbado North', 'Egbado South', 'Ewekoro', 'Ifo', 'Ijebu East', 'Ijebu North', 'Ijebu North East', 'Ijebu Ode', 'Ikenne', 'Imeko Afon', 'Ipokia', 'Obafemi Owode', 'Odeda', 'Odogbolu', 'Ogun Waterside', 'Remo North', 'Sagamu', 'Yewa North', 'Yewa South'],


            'Ondo' => ['Akoko North-East', 'Akoko North-West', 'Akoko South-West', 'Akoko South-East', 'Akure North', 'Akure South', 'Ese Odo', 'Idanre', 'Ifedore', 'Ilaje', 'Ile Oluji/Okeigbo', 'Irele', 'Odigbo', 'Okitipupa', 'Ondo East', 'Ondo West', 'Ose', 'Owo'],


            'Osun' => ['Aiyedaade', 'Aiyedire', 'Atakunmosa East', 'Atakunmosa West', 'Boluwaduro', 'Boripe', 'Ede North', 'Ede South', 'Egbedore', 'Ejigbo', 'Ife Central', 'Ife East', 'Ife North', 'Ife South', 'Ifedayo', 'Ifelodun', 'Ila', 'Ilesa East', 'Ilesa West', 'Irepodun', 'Irewole', 'Isokan', 'Iwo', 'Obokun', 'Odo Otin', 'Ola Oluwa', 'Olorunda', 'Oriade', 'Orolu', 'Osogbo'],


            'Oyo' => ['Afijio', 'Akinyele', 'Atiba', 'Atisbo', 'Egbeda', 'Ibadan North', 'Ibadan North-East', 'Ibadan North-West', 'Ibadan South-East', 'Ibadan South-West', 'Ibarapa Central', 'Ibarapa East', 'Ibarapa North', 'Ido', 'Irepo', 'Iseyin', 'Itesiwaju', 'Iwajowa', 'Kajola', 'Lagelu', 'Ogbomosho North', 'Ogbomosho South', 'Ogo Oluwa', 'Olorunsogo', 'Oluyole', 'Ona Ara', 'Orelope', 'Ori Ire', 'Oyo East', 'Oyo West', 'Saki East', 'Saki West', 'Surulere'],

            'Plateau' => ['Barkin Ladi', 'Bassa', 'Bokkos', 'Jos East', 'Jos North', 'Jos South', 'Kanam', 'Kanke', 'Langtang North', 'Langtang South', 'Mangu', 'Mikang', 'Pankshin', 'Qua’an Pan', 'Riyom', 'Shendam', 'Wase'],

            'Rivers' => ['Abua/Odual', 'Ahoada East', 'Ahoada West', 'Akuku-Toru', 'Andoni', 'Asari-Toru', 'Bonny', 'Degema', 'Emohua', 'Eleme', 'Etche', 'Gokana', 'Ikwerre', 'Khana', 'Obio/Akpor', 'Ogba/Egbema/Ndoni', 'Ogu/Bolo', 'Okrika', 'Omuma', 'Opobo/Nkoro', 'Oyigbo', 'Port Harcourt', 'Tai'],

            'Sokoto' => ['Binji', 'Bodinga', 'Dange Shuni', 'Gada', 'Goronyo', 'Gudu', 'Gwadabawa', 'Illela', 'Isa', 'Kebbe', 'Kware', 'Rabah', 'Sabon Birni', 'Shagari', 'Silame', 'Sokoto North', 'Sokoto South', 'Tambuwal', 'Tangaza', 'Tureta', 'Wamako', 'Wurno', 'Yabo'],

            'Taraba' => ['Ardo Kola', 'Bali', 'Donga', 'Gashaka', 'Gassol', 'Ibi', 'Jalingo', 'Karim Lamido', 'Kumi', 'Lau', 'Sardauna', 'Takum', 'Ussa', 'Wukari', 'Yorro', 'Zing'],

            'Yobe' => ['Bade', 'Bursari', 'Damaturu', 'Fika', 'Fune', 'Geidam', 'Gujba', 'Gulani', 'Jakusko', 'Karasuwa', 'Machina', 'Nangere', 'Nguru', 'Potiskum', 'Tarmuwa', 'Yunusari', 'Yusufari'],

            'Zamfara' => ['Anka', 'Bakura', 'Birnin Magaji/Kiyaw', 'Bukkuyum', 'Bungudu', 'Gummi', 'Gusau', 'Kaura Namoda', 'Maradun', 'Maru', 'Shinkafi', 'Talata Mafara', 'Tsafe', 'Zurmi'],



        ];

        return $localGovernments[$state] ?? [];
    }

    public function countrySelected()
    {
        // Logic to handle country selection
        if ($this->country === 'Nigeria') {
            // Load states for Nigeria
            $this->states = $this->getNigerianStates();
        } else {
            // Clear states if country is not Nigeria
            $this->states = [];
        }
    }

    public function stateSelected()
    {
        // Logic to handle state selection
        if (!empty($this->state)) {
            // Load local governments for the selected state
            $this->localGovernments = $this->getLocalGovernmentsByState($this->state);
        } else {
            // Clear local governments if no state is selected
            $this->localGovernments = [];
        }
    }
}
