<?php

namespace App\Http\Controllers\Business;

use App\Models\Invoice;
use App\Models\Business;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BusinessBalance;
use App\Helpers\BusinessUserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClosingIncomeActivity;
use App\Models\BusinessBalanceActivity;
use App\Models\AccountReceivablePayment;

class DailyIncomeController extends Controller
{
     
    public function index(Business $business)
    {
        $businessUser = BusinessUserHelper::index($business['id'], Auth::user()['id']);
        
        if (!$businessUser && !Auth::user()->hasRole('ADMIN')) {
            return abort(403);
        }
        $invoices = Invoice::where('business_id', $business['id'])->whereDate('updated_at', Carbon::today()->toDateString())->orderBy('id', 'desc')->get();

        $accountReservePayments = AccountReceivablePayment::whereHas('accountReceivable', function($query) use ($business){
                                                                $query->where('business_id', $business['id']);
                                                            })
                                                            ->whereDate('created_at', Carbon::today()
                                                            ->toDateString())
                                                            ->orderBy('id', 'desc')
                                                            ->get();

        $closing = ClosingIncomeActivity::where('business_id', $business['id'])
                                        ->where('tanggal', Carbon::today()->toDateString())
                                        ->first();

        $identity = Identity::first();

        return view('business.daily-income.index', compact('business', 'invoices','accountReservePayments', 'closing', 'identity'));
    }

    public function cashierDetail(Business $business)
    {
        $businessUser = BusinessUserHelper::index($business['id'], Auth::user()['id']);
        
        if (!$businessUser && !Auth::user()->hasRole('ADMIN')) {
            return abort(403);
        } 
        $invoices = Invoice::where('business_id', $business['id'])->whereDate('updated_at', Carbon::today()->toDateString())->orderBy('id', 'desc')->get();
        $identity = Identity::first();

        return view('business.daily-income.cashier-detail', compact('business', 'invoices','identity'));
    }

    public function accountReservePaymentDetail(Business $business)
    {
        $businessUser = BusinessUserHelper::index($business['id'], Auth::user()['id']);
        
        if (!$businessUser && !Auth::user()->hasRole('ADMIN')) {
            return abort(403);
        } 
        $accountReservePayments = AccountReceivablePayment::whereHas('accountReceivable', function($query) use ($business){
                                                            $query->where('business_id', $business['id']);
                                                        })
                                                        ->whereDate('created_at', Carbon::today()
                                                        ->toDateString())
                                                        ->orderBy('id', 'desc')
                                                        ->get();

        return view('business.daily-income.account-reserve-payment-detail', compact('business', 'accountReservePayments'));
    }

    public function closingIncome(Business $business, Request $request)
    {
        $businessUser = BusinessUserHelper::index($business['id'], Auth::user()['id']);
        
        if (!$businessUser && !Auth::user()->hasRole('ADMIN')) {
            return abort(403);
        } 
        $date = Date('Y-m-d');

        // cek apakah sudah di closing
        $closing = ClosingIncomeActivity::where('tanggal', $date)->first();

        if ($closing) {
            $old = $closing['jumlah'];
            $closing->update([
                'jumlah' => $request->jumlah
            ]);

            // kurangi saldo dahulu
            $businessBalance = BusinessBalance::where('business_id', $business['id'])->first();
            $newBalance = $businessBalance['sisa'] - $old;
            $newBalance += $closing['jumlah'];

            $businessBalance->update([
                'sisa' => $newBalance
            ]);

            BusinessBalanceActivity::where('business_balance_id', $businessBalance['id'])->where('tanggal', $date)->first()->update([
                'uang_masuk' => $closing['jumlah'],
            ]);

        } else {

            $closing = ClosingIncomeActivity::create([
                'tanggal' => $date,
                'business_id' => $business['id'],
                'jumlah' => $request->jumlah
            ]);

            // tambah saldo 
            // ambil saldo lama
            $businessBalance = BusinessBalance::where('business_id', $business['id'])->first();

            if ($businessBalance) {
                $old = $businessBalance['sisa'];
                $businessBalance->update([
                    'sisa' => $old + $closing['jumlah']
                ]);

                $businessBalanceActivity = BusinessBalanceActivity::where('business_balance_id', $businessBalance['id'])->where('tanggal', $date)->first();
                
                if ($businessBalanceActivity) {
                    $businessBalanceActivity->update([
                        'uang_masuk' => $closing['jumlah'],
                    ]);
                } else {
                    $businessBalanceActivity = BusinessBalanceActivity::create([
                        'business_balance_id' => $businessBalance['id'],
                        'tanggal' => $date,
                        'uang_masuk' => $closing['jumlah'],
                        'uang_keluar' => null,
                        'keterangan' => 'Uang Masuk Harian'
                    ]);
                }
                
                
                

            } else {
                $businessBalance = BusinessBalance::create([
                    'business_id' => $business['id'],
                    'sisa' => $closing['jumlah']
                ]);

                $businessBalanceActivity = BusinessBalanceActivity::create([
                    'business_balance_id' => $businessBalance['id'],
                    'tanggal' => $date,
                    'uang_masuk' => $closing['jumlah'],
                    'uang_keluar' => null,
                    'keterangan' => 'Uang Masuk Harian'
                ]);
            }
            
        }

        return redirect('/' . $business['id'] . '/daily-incomes')->with('Success', 'Berhasil Memperbaharui Kas');
    }
}
