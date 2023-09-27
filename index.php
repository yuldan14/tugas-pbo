<!DOCTYPE html>
<html>
<head>
    <title>Form Input Karyawan</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nama">Nama Karyawan:</label>
        <input type="text" id="nama" name="nama"><br><br>

        <label for="gaji">Gaji:</label>
        <input type="text" id="gaji" name="gaji"><br><br>

        <label for="jenis">Jenis Karyawan:</label>
        <select id="jenis" name="jenis">
            <option value="permanent">Karyawan Tetap</option>
            <option value="contract">Karyawan Kontrak</option>
        </select><br><br>

        <input type="submit" value="Simpan">
    </form>

    <?php
    // Cek apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namaKaryawan = $_POST["nama"];
        $gajiKaryawan = $_POST["gaji"];
        $jenisKaryawan = $_POST["jenis"];

        // Selanjutnya, Anda dapat menggunakan data ini untuk membuat objek karyawan atau melakukan operasi lain.
        // Misalnya:

        // Buat objek PermanentEmployee atau ContractEmployee sesuai jenis karyawan
        if ($jenisKaryawan == "permanent") {
            $permanentEmployee = new PermanentEmployee($namaKaryawan);
            $permanentEmployee->setSalary($gajiKaryawan);

            // Hitung tunjangan untuk karyawan tetap (5% dari gaji)
            $tunjangan = $permanentEmployee->calculateSalary() * 0.05;
        } elseif ($jenisKaryawan == "contract") {
            $contractEmployee = new ContractEmployee($namaKaryawan);
            $contractEmployee->setSalary($gajiKaryawan);

            
            // Karyawan kontrak tidak mendapatkan tunjangan
            $tunjangan = 0;
        }

        // Menampilkan informasi karyawan dan tunjangan
        echo "<h2>Informasi Karyawan:</h2>";
        if ($jenisKaryawan == "permanent") {
            $permanentEmployee->displayInfo();
        } elseif ($jenisKaryawan == "contract") {
            $contractEmployee->displayInfo();
        }

        $total = $gajiKaryawan + $tunjangan;
        
        echo "<h2>Tunjangan:</h2>";
        echo "Jumlah Tunjangan: $tunjangan<br>";
        echo "<h2>Total Gaji</h2>";
        echo "Jumlah Gaji : $total";
    }
    ?>
</body>
</html>

<?php
// Kode kelas Employee dan PermanentEmployee bisa ditempatkan di sini
class Employee {
    protected $name;
    protected $salary;

    public function __construct($name) {
        $this->name = $name;
    }

    public function calculateSalary() {
        return $this->salary;
    }

    public function displayInfo() {
        echo "Nama: {$this->name}<br>";
        echo "Gaji: {$this->calculateSalary()}<br>";
    }
}

class PermanentEmployee extends Employee {
    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function calculateSalary() {
        return $this->salary;
    }
}

class ContractEmployee extends Employee {
    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function calculateSalary() {
        return $this->salary;
    }
}
?>
