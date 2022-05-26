<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>D'Health | {{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/_vendor/fontawesome-6/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('custom-css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">D'Health || E-Prescription</div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>Nama Pasien </td>
                                    <td>:</td>
                                    <td>{{$prescription->nama_pasien}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal / Waktu</td>
                                    <td>:</td>
                                    <td>{{$prescription->created_at}}</td>
                                </tr>
                            </table>

                            <table id="table-preview" class="display table table-bordered text-dark mt-5 table-striped ">
                                <tr>
                                    <th>No</th>
                                    <th>Obat/Racikan</th>
                                    <th>QTY</th>
                                    <th>Signa</th>
                                </tr>

                                <?php for ($i = 0; $i < sizeOf($prescription_items); $i++) : ?>
                                    <tr>
                                        <th>{{$i+1}}</th>
                                        @if(!$prescription_items[$i]->racikan)
                                        <th>{{$prescription_items[$i]->obatalkes->obatalkes_kode}} - {{$prescription_items[$i]->obatalkes->obatalkes_nama}}</th>
                                        @else
                                        <th>
                                            {{$prescription_items[$i]->racikan->racikan_kode}} - {{$prescription_items[$i]->racikan->racikan_nama}}
                                        </th>
                                        @endif

                                        <th>{{$prescription_items[$i]->qty}}</th>
                                        <th>{{$prescription_items[$i]->signa->signa_nama}}</th>
                                    </tr>

                                    @if($prescription_items[$i]->racikan)
                                    <tr class="text-center">
                                        <td colspan="4">Detail Racikan</td>
                                    </tr>
                                    @foreach($prescription_items[$i]->racikan->obatalkes as $oa)
                                    <tr>
                                        <th>-</th>
                                        <th>{{$oa->obatalkes_kode}} - {{$oa->obatalkes_nama}}</th>
                                        <th>{{$oa->pivot->qty}}</th>
                                        <th>-</th>
                                    </tr>
                                    @endforeach
                                    <tr class="text-center">
                                        <td colspan="4">---</td>
                                    </tr>
                                    @endif
                                <?php endfor ?>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>


        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/_vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/_vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/_vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>

    <script>
        window.print();
    </script>

</body>

</html>