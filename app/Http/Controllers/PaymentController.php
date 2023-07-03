<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Auth;
use Image;

class PaymentController extends Controller
{
    public function paymentView(){
        $customer = Customer::latest()->get();
        $event = Event::latest()->get();
        $product = Product::latest()->get();
        $allData = Payment::latest()->limit(5)->get();
                $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];
        return view('backend.payment.index',compact('customer','product','allData','colors','event'));
    } //End Method

    public function paymentStore(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'purchase_date' => 'required',
            'product_total_amount' => 'required',
            'amount_paid' => 'required',
            'total_amount_paid' => 'required',
            'payment_status' => 'required',
            'event_name' => 'required',
            'product_name' => 'required|array',
            'product_name.*' => 'string',
        ]);

        // Create a new Payment model instance
        $payment = new Payment;
        $payment->customer_name = $request->customer_name;
        $payment->purchase_date = \Carbon\Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
        $payment->product_total_amount = $request->product_total_amount;
        $payment->amount_paid = $request->amount_paid;
        $payment->total_amount_paid = $request->total_amount_paid;
        $payment->payment_status = $request->payment_status;
        $payment->remark = $request->remark;
        $payment->event_name = $request->event_name;

        // Save selected product names as a comma-separated string
        if (count($request->product_name) > 1) {
            $productNames = implode(', ', $request->product_name);
        } else {
            $productNames = $request->product_name[0];
        }
        $payment->product_name = $productNames;

        $payment->save();

        // Redirect back with success message
        $notification = [
            'message' => 'Record created successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }


    public function paidCustomerView(){

        $allData = Payment::where('payment_status','paid')->latest()->get();
        return view('backend.payment.paid_customer',compact('allData'));
    } //End Method

    public function unpaidCustomerView(){
        $customer = Customer::latest()->get();
        $product = Product::latest()->get();
        $allData = Payment::where('payment_status','unpaid')->latest()->get();
        return view('backend.payment.unpaid_customer',compact('allData','customer','product'));
    } //End Method


    public function unpaidCustomerUpdate(Request $request)
    {
        // Validate the request data if needed
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount_paid' => 'required|numeric',
            'remark' => 'nullable|string|max:255',
        ]);

        $payment = Payment::findOrFail($request->payment_id);
        $payment->amount_paid = $request->amount_paid;
        $payment->total_amount_paid = $request->total_amount_paid;
        $payment->payment_status = $request->payment_status;
        $payment->remark = $request->remark;
        $payment->event_name = $request->event_name;
        $payment->save();

        // Redirect back with success message
        $notification = [
            'message' => 'Payment updated successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }

    public function overdueCustomerView(){
        $allData = Payment::where(function ($query) {
            $query->where('payment_status', 'unpaid')->orWhere('payment_status', 'partially');
        })
        ->where('purchase_date', '<=', Carbon::now()->subMonth())->get();
        $status = 'overdue'; // Set the status parameter to 'overdue'
        return view('backend.payment.overdue_customer',compact('allData','status'));
    } //End Method

    public function partiallyCustomerView(){
        $allData = Payment::where('payment_status','partially')->latest()->get();
        return view('backend.payment.partially_customer',compact('allData'));
    } //End Method

    public function totalAmountPaidView(Request $request){
        $allData = Payment::latest()->get();
        return view('backend.payment.total_amount_paid', compact('allData'));
    } //End Method

    public function totalAmountPaidReportView(Request $request){
        $eventName = $request->input('event_name');
         // Fetch the event names for the dropdown menu
        $eventNames = Payment::pluck('event_name')->unique();
        return view('backend.payment.total_amount_paid_report', compact('eventNames'));
    } //End Method

    public function searchByEvent(Request $request){

        $eventName = $request->input('event_name');
        // Perform the search query based on the event name
        $allData = Payment::where('event_name', $eventName)->get();
        // Fetch the event names for the dropdown menu
        $eventNames = Payment::pluck('event_name')->unique();
        return view('backend.payment.total_amount_paid_report', compact('allData', 'eventNames'));
    }

    public function editPayment(){
        $event = Event::latest()->get();
        $allData = Payment::latest()->get();
        return view('backend.payment.edit_payment',compact('allData','event'));
    }

    public function editPaymentUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount_paid' => 'required|numeric',
            'customer_name' => 'required',
            'purchase_date' => 'required',
            'product_total_amount' => 'required',
            'total_amount_paid' => 'required',
            'payment_status' => 'required',
            'event_name' => 'required',
            'product_name' => 'required|array',
            'product_name.*' => 'string',
            'remark' => 'nullable|string|max:255',
            ],
            [
                "amount_paid.required" => "Please input amount paid",
                "customer_name.required" => "Please input customer name",
                "purchase_date.required" => "Please input purchase date",
                "product_total_amount.required" => "Please input product total amount",
                "payment_status.required" => "Please input payment status",
                "event_name.required" => "Please input event name",
                "product_name.required" => "Please input product name",
            ]
        );

        $editPayment = Payment::findOrFail($request->payment_id);
        $editPayment->customer_name = $request->customer_name;
        $editPayment->purchase_date = \Carbon\Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
        $editPayment->product_total_amount = $request->product_total_amount;
        $editPayment->amount_paid = $request->amount_paid;
        // $payment->total_amount_paid = $payment->total_amount_paid;
        $editPayment->total_amount_paid = $request->total_amount_paid;
        $editPayment->payment_status = $request->payment_status;
        $editPayment->remark = $request->remark;
        $editPayment->event_name = $request->event_name;

        $editPayment->save();

        // Redirect back with success message
        $notification = [
            'message' => 'Payment updated successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }

}


