<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator dengan Validasi & Histori</title>
    <style>
        body {
            background: #1e1e1e;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .kalkulator {
            background: #2c2c2c;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
            width: 360px;
        }
        .layar input {
            width: 335px;
            background: #000;
            color: #0f0;
            font-size: 28px;
            text-align: right;
            padding: 15px;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .tombol {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .tombol button {
            padding: 20px;
            font-size: 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .tombol button:hover {
            opacity: 0.9;
        }
        .angka {
            background: #444;
            color: #fff;
        }
        .operator {
            background: #ff9500;
            color: white;
        }
        .clear {
            background: #d32f2f;
            color: white;
        }
        .equal {
            background: #4caf50;
            color: white;
        }
        .hapus-history {
            background: #607d8b;
            color: white;
            grid-column: span 4;
        }
        .histori {
            margin-top: 20px;
            background: #1a1a1a;
            color: #ccc;
            padding: 15px;
            border-radius: 10px;
            max-height: 150px;
            overflow-y: auto;
            font-size: 14px;
        }
        .histori-title {
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="kalkulator">
    <div class="layar">
        <input type="text" id="layar" value="0" oninput="manualInput(this.value)">
    </div>
    <div class="tombol">
        <button class="clear" onclick="clearLayar()">C</button>
        <button class="operator" onclick="tambahSimbol('/')">÷</button>
        <button class="operator" onclick="tambahSimbol('*')">×</button>
        <button class="operator" onclick="hapusAngka()">⌫</button>

        <button class="angka" onclick="tambahSimbol('7')">7</button>
        <button class="angka" onclick="tambahSimbol('8')">8</button>
        <button class="angka" onclick="tambahSimbol('9')">9</button>
        <button class="operator" onclick="tambahSimbol('-')">-</button>

        <button class="angka" onclick="tambahSimbol('4')">4</button>
        <button class="angka" onclick="tambahSimbol('5')">5</button>
        <button class="angka" onclick="tambahSimbol('6')">6</button>
        <button class="operator" onclick="tambahSimbol('+')">+</button>

        <button class="angka" onclick="tambahSimbol('1')">1</button>
        <button class="angka" onclick="tambahSimbol('2')">2</button>
        <button class="angka" onclick="tambahSimbol('3')">3</button>
        <button class="equal" onclick="hitung()">=</button>

        <button class="angka" onclick="tambahSimbol('0')" style="grid-column: span 2;">0</button>
        <button class="angka" onclick="tambahSimbol('.')">.</button>
        
        <button class="hapus-history" onclick="hapusHistori()">Hapus Histori</button>
    </div>

    <div class="histori">
        <div class="histori-title">Histori Perhitungan:</div>
        <div id="daftarHistori"></div>
    </div>
</div>

<script>
    let ekspresi = '';
    let layarInput = document.getElementById('layar');
    let daftarHistori = document.getElementById('daftarHistori');

    function tambahSimbol(simbol) {
        const operator = ['+', '-', '*', '/'];
        const lastChar = ekspresi.slice(-1);

        if (layarInput.value === '0' && !operator.includes(simbol) && simbol !== '.') {
            ekspresi = simbol;
        } else if (operator.includes(lastChar) && operator.includes(simbol)) {
            ekspresi = ekspresi.slice(0, -1) + simbol;
        } else {
            ekspresi += simbol;
        }

        layarInput.value = ekspresi || '0';
    }

    function manualInput(val) {
        ekspresi = val;
    }

    function hapusAngka() {
        ekspresi = ekspresi.slice(0, -1);
        layarInput.value = ekspresi || '0';
    }

    function clearLayar() {
        ekspresi = '';
        layarInput.value = '0';
    }

    function hitung() {

        if (!/^[0-9+\-*/.]+$/.test(ekspresi)) {
            alert('Input tidak valid. Hanya boleh angka dan operator dasar (+, -, *, /, .)');
            layarInput.value = 'Error';
            ekspresi = '';
            return;
        }

        try {
            const hasil = eval(ekspresi);
            tampilkanHistori(ekspresi + ' = ' + hasil);
            ekspresi = hasil.toString();
            layarInput.value = ekspresi;
        } catch (e) {
            layarInput.value = 'Error';
            ekspresi = '';
        }
    }

    function tampilkanHistori(hasil) {
        const elemen = document.createElement('div');
        elemen.innerText = hasil;
        daftarHistori.prepend(elemen);
    }

    function hapusHistori() {
        daftarHistori.innerHTML = '';
    }
</script>

</body>
</html>
