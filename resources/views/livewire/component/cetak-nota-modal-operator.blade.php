<div x-data="{ open: @entangle('open') }">
    <!-- Overlay -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"></div>

    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">

                <!-- Header -->
                <div class="flex items-center justify-between border-b border-default pb-4">
                    <h3 class="text-lg font-semibold text-heading">
                        Cetak Nota Penyetor
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-body hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 flex items-center justify-center">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" /></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="space-y-3 py-3">

                    {{-- Dropdown pelanggan --}}
                    <div>
                        <label class="block mb-2.5 text-sm font-medium text-heading">Pilih Penyetor</label>
                        <select wire:model.live="pelanggan_id" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                            <option value="">-- Pilih Penyetor --</option>
                            @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }} - {{ $p->daerah }}</option>
                            @endforeach
                        </select>

                        @if($tanggal_list)
                        <label class="block mb-2.5 mt-2.5 text-sm font-medium text-heading">Pilih Tanggal</label>
                        <select wire:model.live="tanggal" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
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
                        <h4 class="text-md font-semibold mb-2">Barang Milik Pelanggan:</h4>

                        <div class="max-h-80 overflow-y-auto">
                            <table class="min-w-full text-sm text-left rtl:text-right text-body">
                                <thead class="text-sm text-body text-center bg-neutral-secondary-medium border-b border-t border-default-medium">
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
                                    <tr class="text-center bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
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
                <div class="flex items-center justify-end border-t border-default pt-4 space-x-3">

                    <button wire:click="cetak" class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-base text-sm font-medium">
                        Cetak Nota
                    </button>

                    <button wire:click="closeModal" class="text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium px-4 py-2 rounded-base text-sm">
                        Tutup
                    </button>

                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('open-new-tab', (data) => {
                window.open(data.url, '_blank');
            });
        });

    </script>
</div>
