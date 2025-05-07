@extends('layouts.template')

@section('content')
<section class="accomodation_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>
                        <center>Room Payment</center>
                    </h2>
                </div>
            </div>

            <div class="col-md-12">
                @if (isset($message))
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($transaction && $pay && $dataType)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>Room Number</th>
                                    <th>Room Type</th>
                                    <th>Number of Orders</th>
                                    <th>Total Night</th>
                                    <th>Price Per Night</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center table-primary">
                                    <td>{{ $nomorKamar }}</td>
                                    <td>{{ $dataType->name }}</td>
                                    <td>{{ $jumlahPesanan }}</td>
                                    <td>{{ $totalMalam }}</td>
                                    <td>@currency($dataType->price)</td>
                                    <td>@currency($totalHarga)}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#payType">
                            Pay
                        </button>
                        <div class="modal fade" id="payType" tabindex="-1" role="dialog" aria-labelledby="payTypeLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="payTypeLabel">Select Payment Type</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('customer.pay.transaction', $transaction->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <select name="pay_type" id="pay_type" class="form-control col-md-12 @error('pay_type') is-invalid @enderror" required autocomplete="pay_type" autofocus>
                                                    <option value="bkash">bKash</option>
                                                    <option value="nagad">Nagad</option>
                                                    <option value="rocket">Rocket</option>
                                                </select>
                                                @error('pay_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Pay</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection