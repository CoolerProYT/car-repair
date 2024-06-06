<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Seller;

class Register extends Component
{
    use WithFileUploads;

    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $store_name;
    public $profile_image;
    public $phone_number;
    public $store_address;
    public $store_latitude;
    public $store_longitude;
    public $open_time;
    public $close_time;
    public $state;
    public $area;
    public $verification_code;
    public $correct_code;

    public $areas = [];

    public function getArea(){
        $this->areas = [];
        $state_city_map = [
            "Kuala Lumpur" => ["Kuala Lumpur", "Setapak"],
            "Johor" => ["Ayer Baloi", "Ayer Hitam", "Ayer Tawar 2", "Bandar Penawar", "Bandar Tenggara", "Batu Anam", "Batu Pahat", "Bekok", "Benut", "Bukit Gambir", "Bukit Pasir", "Chaah", "Endau", "Gelang Patah", "Gerisek", "Gugusan Taib Andak", "Jementah", "Johor Bahru", "Kahang", "Kluang", "Kota Tinggi", "Kukup", "Kulai", "Labis", "Layang-Layang", "Masai", "Mersing", "Muar", "Nusajaya", "Pagoh", "Paloh", "Panchor", "Parit Jawa", "Parit Raja", "Parit Sulong", "Pasir Gudang", "Pekan Nenas", "Pengerang", "Pontian", "Rengam", "Rengit", "Segamat", "Semerah", "Senai", "Senggarang", "Seri Gading", "Seri Medan", "Simpang Rengam", "Sungai Mati", "Tangkak", "Tioman", "Ulu Choh", "Ulu Tiram", "Yong Peng"],
            "Kedah" => ["Alor Setar", "Ayer Hitam", "Baling", "Bandar Baharu", "Bandar Bahru", "Bedong", "Bukit Kayu Hitam", "Changloon", "Gurun", "Jeniang", "Jitra", "Karangan", "Kepala Batas", "Kodiang", "Kota Kuala Muda", "Kota Sarang Semut", "Kuala Kedah", "Kuala Ketil", "Kuala Nerang", "Kuala Pegang", "Kulim", "Kupang", "Langgar", "Langkawi", "Lunas", "Merbok", "Padang Serai", "Pendang", "Pokok Sena", "Serdang", "Sik", "Simpang Empat", "Sungai Petani", "Yan"],
            "Kelantan" => ["Ayer Lanas", "Bachok", "Cherang Ruku", "Dabong", "Gua Musang", "Jeli", "Kem Desa Pahlawan", "Ketereh", "Kota Bharu", "Kuala Balah", "Kuala Krai", "Machang", "Melor", "Pasir Mas", "Pasir Puteh", "Pulai Chondong", "Rantau Panjang", "Selising", "Tanah Merah", "Temangan", "Tumpat", "Wakaf Bharu"],
            "Melaka" => ["Alor Gajah", "Asahan", "Ayer Keroh", "Bemban", "Durian Tunggal", "Jasin", "Kem Trendak", "Kuala Sungai Baru", "Lubok China", "Masjid Tanah", "Melaka", "Merlimau", "Selandar", "Sungai Rambai", "Sungai Udang", "Tanjong Kling"],
            "Negeri Sembilan" => ["Bahau", "Bandar Baru Enstek", "Bandar Seri Jempol", "Bandar Seri Sendayan", "Jelebu", "Jempol", "Johan Setia", "Kota", "Kuala Klawang", "Kuala Pilah", "Labu", "Lukut", "Mantin", "Nilai", "Port Dickson", "Pusat Bandar Palong", "Rantau", "Rembau", "Senawang", "Seremban", "Simpang Pertang", "Tampin", "Tanjong Ipoh"],
            "Pahang" => ["Balok", "Bandar Bera", "Bandar Jengka", "Bandar Pusat Jengka", "Bandar Tun Abdul Razak", "Benta", "Bentong", "Brinchang", "Bukit Fraser", "Bukit Goh", "Bukit Kuin", "Bukit Tinggi", "Cameron Highlands", "Chenor", "Chini", "Damak", "Dong", "Gambang", "Genting Highlands", "Jerantut", "Karak", "Kemayan", "Kerdau", "Kuala Krau", "Kuala Lipis", "Kuala Rompin", "Kuantan", "Lanchang", "Lembing", "Maran", "Mentakab", "Muadzam Shah", "Padang Tengku", "Pekan", "Raub", "Ringlet", "Rompin", "Sega", "Sungai Koyan", "Tanah Rata", "Temerloh", "Triang"],
            "Perak" => ["Ayer Tawar", "Bagan Datoh", "Bagan Serai", "Batu Gajah", "Batu Kurau", "Behrang Stesen", "Bidor", "Bota", "Bukit Merah", "Changkat Jering", "Changkat Keruing", "Chenderiang", "Chenderong Balai", "Enggor", "Gerik", "Gopeng", "Hutan Melintang", "Intan", "Ipoh", "Jeram", "Kampar", "Kampong Gajah", "Kuala Kangsar", "Kuala Kurau", "Kuala Sepetang", "Lahat", "Langkap", "Lenggong", "Lumut", "Malim Nawar", "Mambang Di Awan", "Matang", "Menglembu", "Padang Rengas", "Pangkor", "Pantai Remis", "Parit", "Parit Buntar", "Pengkalan Hulu", "Pusing", "Rantau Panjang", "Sauk", "Selama", "Selekoh", "Semanggol", "Sitiawan", "Slim River", "Sungai Siput", "Sungai Sumun", "Sungkai", "Taiping", "Tanjong Malim", "Tanjong Piandang", "Tanjong Rambutan", "Tanjong Tualang", "Tapah", "Tapah Road", "Teluk Intan", "Temoh", "Trolak", "Trong", "Tronoh", "Ulu Bernam", "Ulu Kinta"],
            "Perlis" => ["Arau", "Kaki Bukit", "Kangar", "Kuala Perlis", "Padang Besar", "Simpang Ampat"],
            "Penang" => ["Balik Pulau", "Batu Ferringhi", "Batu Maung", "Batu Uban", "Bukit Mertajam", "Bukit Tambun", "Butterworth", "Gelugor", "Jelutong", "Kepala Batas", "Kubang Semang", "Nibong Tebal", "Penang", "Permatang Pauh", "Perai", "Pulau Tikus", "Seberang Jaya", "Simpang Ampat", "Sungai Ara", "Sungai Bakap", "Sungai Dua", "Tanjong Bungah", "Tasek Gelugor"],
            "Sabah" => ["Beaufort", "Beluran", "Bongawan", "Inanam", "Keningau", "Kota Belud", "Kota Kinabalu", "Kota Kinabatangan", "Kota Marudu", "Kuala Penyu", "Kudat", "Kunak", "Lahad Datu", "Likas", "Membakut", "Menumbok", "Nabawan", "Pamol", "Papar", "Penampang", "Putatan", "Ranau", "Sandakan", "Semporna", "Sipitang", "Tambunan", "Tamparuli", "Tawau", "Telupid", "Tenom", "Tuaran"],
            "Sarawak" => ["Asajaya", "Balingian", "Baram", "Bau", "Bekenu", "Belaga", "Belawai", "Betong", "Bintangor", "Bintulu", "Debak", "Dalat", "Daro", "Engkilili", "Julau", "Kabong", "Kapit", "Kuching", "Lawas", "Limbang", "Lingga", "Lubok Antu", "Lundu", "Lutong", "Maradong", "Marudi", "Matu", "Meludam", "Meradong", "Miri", "Mukah", "Nanga Medamit", "Niah", "Pusa", "Roban", "Samarahan", "Saratok", "Sarikei", "Sebauh", "Serian", "Sibu", "Simunjan", "Song", "Spaoh", "Sri Aman", "Sundar", "Tanjong Kidurong", "Tatau"],
            "Selangor" => ["Ampang", "Balakong", "Bangi", "Banting", "Batang Kali", "Beranang", "Bestari Jaya", "Bukit Rotan", "Cheras", "Cyberjaya", "Dengkil", "Gombak", "Hulu Langat", "Hulu Selangor", "Jenjarom", "Jeram", "Kajang", "Kapar", "Klang", "Kuala Kubu Baru", "Kuala Selangor", "Kuang", "Petaling Jaya", "Puchong", "Pulau Carey", "Rawang", "Sabak Bernam", "Sekinchan", "Semenyih", "Sepang", "Serdang", "Serendah", "Seri Kembangan", "Setia Alam", "Shah Alam", "Subang Jaya", "Sungai Ayer Tawar", "Sungai Besar", "Sungai Buloh", "Telok Panglima Garang"],
            "Terengganu" => ["Ajil", "Al Muktatfi Billah Shah", "Ayer Puteh", "Bukit Besi", "Bukit Payong", "Ceneh", "Cukai", "Dungun", "Jerteh", "Jabi", "Kampong Raja", "Kerteh", "Kijal", "Kuala Berang", "Kuala Terengganu", "Marang", "Paka", "Permaisuri", "Sungai Tong"],
            "Labuan" => ["Labuan"],
            "Putrajaya" => ["Putrajaya"]
        ];

        $this->areas = $state_city_map[$this->state];
    }

    public function register(){
        $this->validate([
            'username' => 'required',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password',
            'phone_number' => 'required|regex:/^01[0-9]{8,9}$/|unique:sellers,phone_number',
            'profile_image' => 'required|image|max:4096',
            'store_name' => 'required',
            'store_address' => 'required',
            'store_latitude' => 'required',
            'store_longitude' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'state' => 'required',
            'area' => 'required',
            'verification_code' => 'required'
        ]);

        if($this->verification_code != $this->correct_code){
            return $this->addError('verification_code', 'The verification code is incorrect!');
        }

        $this->open_time = date('H:i:s', strtotime($this->open_time));
        $this->close_time = date('H:i:s', strtotime($this->close_time));

        $filePath = $this->profile_image->getRealPath();
        $fileName = Str::random(40) . '.' . $this->profile_image->getClientOriginalExtension();

        $disk = Storage::disk('gcs');
        $disk->put('seller_profile_image/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        Seller::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone_number' => $this->phone_number,
            'profile_image' => 'seller_profile_image/' . $fileName,
            'store_name' => $this->store_name,
            'store_address' => $this->store_address,
            'store_latitude' => $this->store_latitude,
            'store_longitude' => $this->store_longitude,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'state' => $this->state,
            'area' => $this->area,
        ]);

        return redirect()->route('seller.login')->with('success', 'Your seller account has been created!');
    }

    public function getCode(){
        $this->validate([
            'email' => 'required|email|unique:sellers,email',
        ]);

        $this->correct_code = rand(100000,999999);

        $resend = \Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => 'noreply <noreply@jinitaimei.cloud>',
            'to' => [$this->email],
            'subject' => 'Verification Code',
            'text' => "Your verification code is: $this->correct_code"
        ]);

        return session()->flash('success', 'Verification code has been sent to your email!');
    }

    public function updateCoordinate($lat,$lon){
        $this->store_latitude = $lat;
        $this->store_longitude = $lon;
    }

    public function render()
    {
        return view('livewire.seller.register');
    }
}
