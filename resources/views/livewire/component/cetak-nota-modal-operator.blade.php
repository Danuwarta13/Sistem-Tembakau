<div x-data="{ open: @entangle('open') }">
    <!-- Overlay -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"></div>

    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="relative w-full max-w-2xl max-h-[90vh] mx-2 sm:mx-4 md:mx-auto">
            <!-- Modal content -->
            <div
                class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-3 sm:p-4 md:p-6 flex flex-col max-h-[90vh]">

                <!-- Header -->
                <div class="flex items-center justify-between border-b border-default pb-4 shrink-0">

                    <h3 class="text-base sm:text-lg font-semibold text-heading">
                        Cetak Nota Penyetor
                    </h3>
                    <button type="button" wire:click="closeModal"
                        class="text-body hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 flex items-center justify-center">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="space-y-3 py-3 overflow-y-auto flex-1 no-scrollbar">
                    {{-- Dropdown pelanggan --}}
                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-heading dark:text-white">Pilih
                            Penyetor</label>
                        <select wire:model.live="pelanggan_id"
                            class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                            <option value="">-- Pilih Penyetor --</option>
                            @foreach($pelanggans as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} - {{ $p->daerah }}</option>
                            @endforeach
                        </select>

                        @if($tanggal_list)
                            <label class="block mb-2.5 mt-2.5 text-sm font-medium text-heading">Pilih Tanggal</label>
                            <select wire:model.live="tanggal"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                <option value="">-- Pilih Tanggal --</option>
                                @foreach($tanggal_list as $tgl)
                                    <option value="{{ $tgl }}">{{ \Carbon\Carbon::parse($tgl)->format('d M Y') }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    {{-- List barang setelah pelanggan dipilih --}}
                    @if($pelanggan_id && count($barangs) > 0)
                        <div>
                            <h4 class="text-md font-semibold mb-2 dark:text-white">Barang Milik Pelanggan:</h4>

                            <div class="max-h-44 overflow-y-auto overflow-x-auto">
                                <table class="min-w-full text-sm text-left rtl:text-right text-body">
                                    <thead
                                        class="text-sm text-body text-center bg-neutral-secondary-medium border-b border-t border-default-medium">
                                        <tr>
                                            <th scope="col" class="px-3 py-3 font-medium">Tanggal</th>
                                            <th scope="col" class="px-3 py-3 font-medium">No Seri</th>
                                            <th scope="col" class="px-3 py-3 font-medium">Grade</th>
                                            <th scope="col" class="px-3 py-3 font-medium">Bruto</th>
                                            <th scope="col" class="px-3 py-3 font-medium">Netto</th>
                                            <th scope="col" class="px-3 py-3 font-medium">Harga</th>
                                            <th scope="col" class="px-3 py-3 font-medium">Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($barangs as $b)
                                            <tr
                                                class="text-center bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                                <td class="px-6 py-4">{{ $b->tanggal }}</td>
                                                <td class="px-6 py-4">{{ $b->no_seri }}</td>
                                                <td class="px-6 py-4">{{ $b->grade }}</td>
                                                <td class="px-6 py-4">{{ to_koma($b->bruto) }}</td>
                                                <td class="px-6 py-4">{{ to_koma($b->netto) }}</td>
                                                <td class="px-6 py-4">{{ number_format($b->harga) }}</td>
                                                <td class="px-6 py-4">{{ number_format($b->jumlah) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @elseif($pelanggan_id)
                        <p class="text-sm text-red-500">Tidak ada barang milik pelanggan ini.</p>
                    @endif

                </div>

                <!-- Footer -->
                <div
                    class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end border-t border-default pt-4 gap-2 sm:gap-3 shrink-0">

                    <button wire:click="cetakLangsung"
                        class="flex items-center justify-center gap-2 text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-base text-sm font-medium">
                        <svg class="w-5 h-5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                        </svg>
                    </button>

                    <!-- <button wire:click="cetak"
                        class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-base text-sm font-medium w-full sm:w-auto">
                        Cetak Nota
                    </button> -->

                    <button wire:click="closeModal"
                        class="text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium px-4 py-2 rounded-base text-sm w-full sm:w-auto">
                        Tutup
                    </button>

                </div>

            </div>
        </div>
    </div>
    <script>
        // Open in New Tab Nota PDF
        // document.addEventListener('livewire:initialized', () => {
        //     Livewire.on('open-new-tab', (data) => {
        //         window.open(data.url, '_blank');
        //     });
        // });

        // Auto Print PDF Tanpa Pindah Halamn 
        // document.addEventListener('livewire:initialized', () => {
        //     Livewire.on('print-pdf', (data) => {
        //         let iframe = document.createElement('iframe');
        //         iframe.style.display = 'none';
        //         iframe.src = data.url;
        //         document.body.appendChild(iframe);

        //         iframe.onload = function () {
        //             iframe.contentWindow.focus();
        //             iframe.contentWindow.print();

        //             iframe.contentWindow.onafterprint = function () {
        //                 document.body.removeChild(iframe);

        //                 Livewire.dispatch('print-success');
        //             };
        //         };
        //     });
        // });

        // Print Struk Bluetooth
        document.addEventListener('livewire:init', () => {

            Livewire.on('print-struk', async (event) => {

                const data = event.data;

                await printStruk(data);

            });

        });

        async function printStruk(data) {
            try {
                if (!characteristic) {
                    alert("Connect dulu!");
                    return;
                }

                const encoder = new TextEncoder();
                let lines = [];
                const WIDTH = 32;

                // ===== HELPER =====
                function col(text, length, align = 'left') {
                    text = String(text ?? '');

                    if (text.length > length) {
                        return text.substring(0, length);
                    }

                    return align === 'right'
                        ? text.padStart(length, ' ')
                        : text.padEnd(length, ' ');
                }

                function line() {
                    return "-".repeat(WIDTH) + "\n";
                }

                function padText(left, right) {
                    left = String(left);
                    right = String(right);
                    let space = WIDTH - left.length - right.length;
                    return left + " ".repeat(space) + right + "\n";
                }

                function angka(n) {
                    return Number(n ?? 0).toLocaleString('id-ID');
                }

                function rupiah(n) {
                    return "Rp " + angka(n);
                }

                function angkaFix(n) {
                    return parseInt(n ?? 0); // hilangkan .00
                }

                // ===== INIT =====
                lines.push("\x1B\x40");

                // ===== HEADER =====
                lines.push("\x1B\x61\x01");
                lines.push("\x1B\x45\x01");
                lines.push("NOTA PEMBAYARAN\n");
                lines.push("\x1B\x45\x00");

                lines.push("CV. Contoh Usaha\n");
                lines.push("Jl. Contoh Alamat\n\n");

                // ===== LEFT =====
                lines.push("\x1B\x61\x00");

                lines.push("Tanggal : " + data.tanggal + "\n");
                lines.push("Nama    : " + (data.pelanggan?.nama ?? '-') + "\n");
                lines.push("Daerah  : " + (data.pelanggan?.daerah ?? '-') + "\n");

                lines.push(line());

                // ===== HEADER TABEL =====
                lines.push(
                    col("No", 3) +
                    col("Gr", 3) +
                    col("Br", 4) +
                    col("Nt", 4) +
                    col("Harga", 8, 'right') +
                    col("Jml", 10, 'right') + "\n"
                );

                lines.push(line());

                // ===== ITEMS =====
                data.items.forEach((item, index) => {
                    lines.push(
                        col(index + 1, 3) +
                        col(item.grade, 3) +
                        col(angkaFix(item.bruto), 4) +
                        col(angkaFix(item.netto), 4) +
                        col(angka(item.harga), 8, 'right') +
                        col(angka(item.jumlah), 10, 'right') +
                        "\n"
                    );
                });

                lines.push(line());

                // ===== TOTAL =====
                lines.push(padText("Total", rupiah(data.totalJumlah)));
                lines.push(padText("Pajak", rupiah(data.totalPajak)));
                lines.push(padText("Kuli", rupiah(data.totalKuli)));

                lines.push(line());

                lines.push("\x1B\x45\x01");
                lines.push(padText("TOTAL", rupiah(data.hasil)));
                lines.push("\x1B\x45\x00");

                // ===== FOOTER =====
                lines.push("\n");
                lines.push("\x1B\x61\x01");
                lines.push("Terima Kasih\n\n\n");
                lines.push("\n");
                lines.push("\n");

                // ===== PRINT =====
                for (let line of lines) {
                    await characteristic.writeValueWithoutResponse(encoder.encode(line));
                    await new Promise(r => setTimeout(r, 30));
                }

            } catch (err) {
                console.log(err);
            }
        }

    </script>
</div>