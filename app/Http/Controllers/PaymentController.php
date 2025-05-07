<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use PDF;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)
            ->where('status', 'waiting for payment')
            ->latest('created_at')
            ->first();
    
        if (!$transaction) {
            return view('payment.index', [
                'message' => 'No pending transactions found.',
                'nomorKamar' => 'N/A',
                'totalHarga' => 0,
                'totalMalam' => 0,
                'jumlahPesanan' => 0,
                'transaction' => null,
                'dataType' => null,
                'pay' => null,
            ])->withErrors(['message' => 'No pending transactions found.']);
        }
    
        $pay = Payment::where('transaction_id', '=', $transaction->id)->first();
        if (!$pay) {
            return view('payment.index', [
                'message' => 'No payment record found for this transaction.',
                'nomorKamar' => 'N/A',
                'totalHarga' => 0,
                'totalMalam' => 0,
                'jumlahPesanan' => 0,
                'transaction' => $transaction,
                'dataType' => null,
                'pay' => null,
            ])->withErrors(['message' => 'No payment record found for this transaction.']);
        }
    
        $totalHarga = $pay->price;
        $jumlahPesanan = $transaction->many_room;
        $roomId = is_string($transaction->room_id) ? explode(', ', $transaction->room_id) : (array)$transaction->room_id;
    
        $check_in = Carbon::parse($transaction->check_in);
        $check_out = Carbon::parse($transaction->check_out);
        $totalMalam = $check_in->diffInDays($check_out);
    
        $kamar = Room::whereIn('id', $roomId)->get();
        if ($kamar->isEmpty()) {
            return view('payment.index', [
                'message' => 'No rooms found for this transaction.',
                'nomorKamar' => 'N/A',
                'totalHarga' => $totalHarga,
                'totalMalam' => $totalMalam,
                'jumlahPesanan' => $jumlahPesanan,
                'transaction' => $transaction,
                'dataType' => null,
                'pay' => $pay,
            ])->withErrors(['message' => 'No rooms found for this transaction.']);
        }
    
        $dataType = RoomType::where('id', '=', $kamar[0]->type_id)->first();
        if (!$dataType) {
            return view('payment.index', [
                'message' => 'Room type not found for this transaction.',
                'nomorKamar' => 'N/A',
                'totalHarga' => $totalHarga,
                'totalMalam' => $totalMalam,
                'jumlahPesanan' => $jumlahPesanan,
                'transaction' => $transaction,
                'dataType' => null,
                'pay' => $pay,
            ])->withErrors(['message' => 'Room type not found for this transaction.']);
        }
    
        $nomorKamar = $kamar->pluck('number')->implode(', '); // Simplified using pluck and implode
    
        return view('payment.index', compact('nomorKamar', 'totalHarga', 'totalMalam', 'jumlahPesanan', 'transaction', 'dataType', 'pay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoice(Request $request)
    {
        $transactionId = Transaction::where('user_id', Auth::user()->id)
            ->where('status', 'waiting for payment')
            ->pluck('id');
    
        $pay = Payment::whereIn('transaction_id', $transactionId)->get();
        if ($pay->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'No payments found for pending transactions.']);
        }
    
        $totalHarga = 0;
        $idPayment = [];
        foreach ($pay as $val) {
            $idPayment[] = $val->id;
            $totalHarga += $val->price;
        }
    
        $idPayment = implode(', ', $idPayment);
    
        // Add payment type details
        if ($request->pay_type == "bikash") {

            $pay->url = 'https://www.bkash.com';
            $pay->type = 'bKash';
            $pay->nomor = '+8801712345678'; // Placeholder Bangladeshi number
        } else if ($request->pay_type == "nagad") {
            $pay->url = 'https://www.nagad.com.bd';
            $pay->type = 'Nagad';
            $pay->nomor = '+8801812345678'; // Placeholder Bangladeshi number
        } else if ($request->pay_type == "rocket") {
            $pay->url = 'https://www.dutchbanglabank.com/rocket';
            $pay->type = 'Rocket';
            $pay->nomor = '+8801912345678'; // Placeholder Bangladeshi number
        } else {
            $pay->url = 'error';
            $pay->type = 'error';
            $pay->nomor = 'error';
        }
    
        return view('payment.invoice', compact('totalHarga', 'pay', 'idPayment'));
    }

    public function transactionProofPrint($id)
    {
        $data = Transaction::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['message' => 'Transaction not found.']);
        }
    
        $roomId = explode(', ', $data->room_id);
        $kamar = Room::whereIn('id', $roomId)->get();
        if ($kamar->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'No rooms found for this transaction.']);
        }
        $dataType = RoomType::where('id', '=', $kamar[0]->type_id)->first();
        if (!$dataType) {
            return redirect()->back()->withErrors(['message' => 'Room type not found.']);
        }
    
        foreach ($kamar as $val) {
            $nomorKamar[] = $val->number;
        }
        $nomorKamar = implode(', ', $nomorKamar);
        $data->nomorKamar = $nomorKamar;
    
        $pdf = PDF::loadView('pdf.print-proof', ['data' => $data]);
        return $pdf->download('proof-pembayaran.pdf');
    }

    public function uploadProof(Request $request)
    {
        $imgName = time() . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('images/proof'), $imgName);
    
        $paymentsId = explode(', ', $request->payment_id);
        $payments = Payment::whereIn('id', $paymentsId)->get();
        if ($payments->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'No valid payment IDs found.']);
        }
    
        foreach ($payments as $val) {
            $val->update(['proof' => $imgName]);
            $data = Transaction::find($val->transaction_id);
            if (!$data) {
                return redirect()->back()->withErrors(['message' => 'Transaction not found for payment ID: ' . $val->id]);
            }
            $data->update(['status' => 'process']);
    
            $logpay = date('YmdHis') . '_customer_pay_transaction';
            Log::create([
                'transaction_id' => $data->id,
                'log' => $logpay,
                'executor_id' => Auth::user()->id,
            ]);
    
            $log = date('YmdHis') . '_receptionist_toProcess_order';
            Log::create([
                'transaction_id' => $data->id,
                'log' => $log,
                'executor_id' => Auth::user()->id,
            ]);
        }
    
        return redirect()->route('customer.transactions');
    }

    public function receptionisUploadProof(Request $request)
    {
        $imgName = time() . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('images/proof'), $imgName);

        $pay = Payment::find($request->payment_id);
        $pay->update(['proof' => $imgName]);
        $data = Transaction::find($pay->transaction_id);
        $data->update(['status' => 'process']);

        $logpay = date('YmdHis') . '_customer_pay_transaction';
        Log::create([
            'transaction_id' => $data->id,
            'log' => $logpay,
            'executor_id' => Auth::user()->id,
        ]);

        $log = date('YmdHis') . '_receptionist_toProcess_order';
        Log::create([
            'transaction_id' => $data->id,
            'log' => $log,
            'executor_id' => Auth::user()->id,
        ]);

        return redirect()->route('customer.transactions');
    }
}
