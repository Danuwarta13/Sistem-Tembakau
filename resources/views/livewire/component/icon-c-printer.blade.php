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

        // let device;
        let characteristic;

        const SERVICE_UUID = '000018f0-0000-1000-8000-00805f9b34fb';

        // CONNECT (PAKSA PILIH DEVICE)
        async function connectPrinter() {
            console.log("connectPrinter");
            try {
                device = await navigator.bluetooth.requestDevice({
                    acceptAllDevices: true
                    , optionalServices: [SERVICE_UUID]
                });

                const server = await device.gatt.connect();
                const service = await server.getPrimaryService(SERVICE_UUID);

                const characteristics = await service.getCharacteristics();

                console.log("CHAR:", characteristics);

                // ambil SEMBARANG dulu (biar pasti jalan)
                characteristic = characteristics[0];

                alert("Connected: " + device.name);

            } catch (err) {
                console.log(err);
            }
        }

    </script>
</div>