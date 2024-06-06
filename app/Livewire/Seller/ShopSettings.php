<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShopSettings extends Component
{
    public $store_name;
    public $store_address;
    public $store_latitude;
    public $store_longitude;
    public $open_time;
    public $close_time;
    public $area;
    public $state;

    public $areas;

    public $flag = '';

    public function mount(){
        $this->state = Auth::guard('seller')->user()->state;
        $this->area = Auth::guard('seller')->user()->area;
        $this->getArea();
        $this->store_name = Auth::guard('seller')->user()->store_name;
        $this->store_address = Auth::guard('seller')->user()->store_address;
        $this->store_latitude = Auth::guard('seller')->user()->store_latitude;
        $this->store_longitude = Auth::guard('seller')->user()->store_longitude;
        $this->open_time = Auth::guard('seller')->user()->open_time;
        $this->close_time = Auth::guard('seller')->user()->close_time;
    }

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

    public function updateFlag($flag){
        $this->flag = $flag;
    }

    public function changeName(){
        $this->validate([
            'store_name' => 'required|string|max:255',
        ]);

        Auth::guard('seller')->user()->update([
            'store_name' => $this->store_name,
        ]);

        $this->flag = '';
    }

    public function changeAddress(){
        $this->validate([
            'store_address' => 'required|string|max:255',
        ]);

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($this->store_address) . "&key=" . env('GOOGLE_MAP_API_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $location = $data['results'][0]['geometry']['location'];
        $this->store_latitude = $location['lat'];
        $this->store_longitude = $location['lng'];

        Auth::guard('seller')->user()->update([
            'store_address' => $this->store_address,
            'store_latitude' => $this->store_latitude,
            'store_longitude' => $this->store_longitude,
        ]);

        $this->flag = '';
    }

    public function changeTime(){
        $this->validate([
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $this->open_time = date('H:i:s', strtotime($this->open_time));
        $this->close_time = date('H:i:s', strtotime($this->close_time));

        Auth::guard('seller')->user()->update([
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
        ]);

        $this->flag = '';
    }

    public function changeState(){
        $this->validate([
            'state' => 'required',
        ]);

        Auth::guard('seller')->user()->update([
            'state' => $this->state,
        ]);

        $this->flag = '';
    }

    public function changeArea(){
        $this->validate([
            'area' => 'required',
        ]);

        Auth::guard('seller')->user()->update([
            'area' => $this->area,
        ]);

        $this->flag = '';
    }

    public function render()
    {
        return view('livewire.seller.shop-settings');
    }
}
