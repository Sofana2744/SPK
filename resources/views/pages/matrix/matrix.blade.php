<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    @include('components.flash-messages')

    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    @foreach ($criteria as $row)
                        <th>{{ $row->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $i = 0;
                @endphp
                @foreach ($criteria as $row)
                    @php
                        $t = 0;
                    @endphp
                    <tr>
                        <th>{{ $row->name }}</th>
                        @foreach ($criteria as $row2)
                            <td>{{ $data[$i][$t] }}</td>
                            @php
                                $t++;
                            @endphp
                        @endforeach
                        @php
                            $i++;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    @php
                        $transposed = [];
                        for ($i = 0; $i < count($criteria); $i++) {
                            $transposed[$i] = array_column($data, $i);
                        }
                        $columnSums = array_map('array_sum', $transposed);
                    @endphp
                    @foreach ($columnSums as $sum)
                        <td>{{ $sum }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <div class="btn btn-gray mt-5">Normalisasi Matriks</div>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    @foreach ($criteria as $row)
                        <th>{{ $row->name }}</th>
                    @endforeach
                    <th>Prioritas</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Normalisasikan matriks
                    $normalizedData = [];
                    foreach ($data as $row) {
                        $normalizedRow = [];
                        for ($i = 0; $i < count($row); $i++) {
                            // Pastikan untuk menangani pembagian dengan nol
                            $normalizedRow[] = $columnSums[$i] != 0 ? $row[$i] / $columnSums[$i] : 0;
                        }
                        $normalizedData[] = $normalizedRow;
                    }
                    // Hitung nilai prioritas (rata-rata setiap baris dari matriks yang telah dinormalisasi)
                    $priorities = [];
                    foreach ($normalizedData as $row) {
                        $priorities[] = array_sum($row) / count($row);
                    }

                    // Hitung lambda max
                    $lambdaMax = 0;
                    for ($i = 0; $i < count($data); $i++) {
                        $sumProduct = 0;
                        for ($j = 0; $j < count($data[$i]); $j++) {
                            $sumProduct += $data[$i][$j] * $priorities[$j];
                        }
                        $lambdaMax += $sumProduct;
                    }
                    $lambdaMax /= count($priorities);

                    // Hitung Consistency Index (CI)
                    $n = count($data);
                    $ci = ($lambdaMax - $n) / ($n - 1);

                    // Tabel nilai IR berdasarkan jumlah kriteria (n)
                    $irValues = [
                        1 => 0.0,
                        2 => 0.0,
                        3 => 0.58,
                        4 => 0.9,
                        5 => 1.12,
                        6 => 1.24,
                        7 => 1.32,
                        8 => 1.41,
                        9 => 1.45,
                        10 => 1.49,
                    ];
                    $ir = $irValues[$n];

                    // Hitung Consistency Ratio (CR)
                    $cr = $ir != 0 ? $ci / $ir : 0;
                    // Inisialisasi ulang indeks
                    $i = 0;
                @endphp
                @foreach ($criteria as $row)
                    <tr>
                        <th>{{ $row->name }}</th>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($criteria as $row2)
                            <td>{{ number_format($normalizedData[$i][$t], 2, '.', '') }}</td>
                            @php
                                $t++;
                            @endphp
                        @endforeach
                        <td>{{ number_format($priorities[$i], 2, '.', '') }}</td>
                        @php
                            $i++;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <hr class="border-2 border-black mt-12">

    <h1 class="text-black mt-28 text-lg font-bold">Table Nilai Prefentif</h1>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    @foreach ($criteria as $row)
                        <th>{{ $row->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $sumtotal = [];
                @endphp
                @foreach ($alternative as $row)
                    @php
                        $total = [];
                        $index = 0;
                    @endphp
                    <tr>
                        <th>{{ $row->name }}</th>
                        @foreach ($row->subAlternative as $item)
                            <th>{{ number_format($item->NormalisasiAlternative->value * $priorities[$index], 2, '.', '') }}</th>
                            @php
                                array_push($total, $item->NormalisasiAlternative->value * $priorities[$index]);
                                $index++;
                            @endphp
                        @endforeach
                        @php
                            $sum = array_sum($total);
                            $sumtotal[$row->name] = $sum;
                        @endphp
                        <td class="text-black font-bold">{{ number_format($sum, 2, '.', '') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @php
        arsort($sumtotal);
    @endphp
    <div>
        <h4>Ranking:</h4>
        <ol>
            @foreach ($sumtotal as $key => $value)
                <li>{{ $key }}: {{ number_format($value, 2, '.', '') }}</li>
            @endforeach
        </ol>
    </div>

    <div class="mt-4">
        <h4>Consistency Ratio (CR)</h4>
        <p>Lambda Max (λ_max): {{ number_format($lambdaMax, 4, '.', '') }}</p>
        <p>Consistency Index (CI): {{ number_format($ci, 4, '.', '') }}</p>
        <p>Index Random Consistency (IR): {{ $ir }}</p>
        <p>Consistency Ratio (CR): {{ number_format($cr, 4, '.', '') }}</p>
    </div>

    
</x-layout>
