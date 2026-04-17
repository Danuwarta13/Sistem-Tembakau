<div>
    <button onclick="connectPrinter()"
        class="p-2 flex items-center gap-2 rounded-base bg-transparent hover:bg-neutral-secondary-medium border border-transparent">
        <svg id="printer-icon" class="w-6 h-6 text-heading" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none">
            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6" />
            <rect x="6" y="14" width="12" height="8" rx="1" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="text-xs font-medium text-heading hidden md:block">Connect printer</span>
    </button>

    <script>
        // PRINT BLUETOOTH

        // var device;
        var characteristic;

        var SERVICE_UUID = '000018f0-0000-1000-8000-00805f9b34fb';

        function initAutoConnect() {
            if (navigator.bluetooth && navigator.bluetooth.getDevices) {
                navigator.bluetooth.getDevices().then(devices => {
                    console.log("Daftar device tersimpan:", devices);
                    if (devices.length > 0) {
                        console.log("Mencoba auto-connect ke device sebelumnya...");
                        var device = devices[0];
                        connectToDevice(device);
                    } else {
                        console.log("Tidak ada histori device bluetooth yang tersimpan.");
                    }
                }).catch(err => {
                    console.log("Auto-connect getDevices gagal:", err);
                });
            } else {
                console.log("Fitur auto-connect (getDevices) tidak didukung browser ini.");
            }
        }

        // Panggil langsung (berguna jika script dimuat via Livewire setelah DOMContentLoaded terlewat)
        initAutoConnect();

        // Panggil auto-connect saat awal load
        document.addEventListener('DOMContentLoaded', initAutoConnect);
        // Dan panggil saat Livewire navigasi jika menggunakan wire:navigate
        document.addEventListener('livewire:navigated', initAutoConnect);

        // CONNECT (PAKSA PILIH DEVICE BARU via klik tombol)
        async function connectPrinter() {
            console.log("connectPrinter");

            try {
                var device = await navigator.bluetooth.requestDevice({
                    acceptAllDevices: true,
                    optionalServices: [SERVICE_UUID]
                });

                await connectToDevice(device);

            } catch (err) {
                console.log("Batal pilih device / error:", err);
            }
        }

        async function connectToDevice(selectedDevice) {
            try {
                const server = await selectedDevice.gatt.connect();
                const service = await server.getPrimaryService(SERVICE_UUID);

                const characteristics = await service.getCharacteristics();

                console.log("SEMUA CHAR:", characteristics);

                // 🔥 PILIH YANG SUPPORT WRITE
                characteristic = characteristics.find(c =>
                    c.properties.write || c.properties.writeWithoutResponse
                );

                if (!characteristic) {
                    alert("Tidak ada characteristic yang bisa write!");
                    return;
                }

                console.log("PAKAI CHAR:", characteristic);
                console.log("PROPERTIES:", characteristic.properties);

                selectedDevice.addEventListener('gattserverdisconnected', function (event) {
                    console.log("Bluetooth tertutup/disconnected:", event.target.name);
                    characteristic = null;
                });

                Livewire.dispatch('printer-connected');

            } catch (err) {
                console.log("Gagal melakukan koneksi ke device:", err);
            }
        }

    </script>
</div>