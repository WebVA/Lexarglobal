<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Customer;
use App\Models\Contactus;
use App\Models\State;
use App\Models\Country;
use App\Exports\CustomerExport;
use App\Exports\SubscriberExport;
use App\Exports\ContactExport;
use App\Models\Subscriber;
use DB;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show_customers()
    {
        $customer = Customer::all();
        return view('dashboard.customers')->with('result', $customer);
    }

    public function add_customer()
    {
        $state = State::all();
        $country = Country::all();
        return view('dashboard.add_customer')->with('state', $state)->with('country', $country);
    }

    public function add_customer_api()
    {
        $first_name = request()->first_name ? request()->first_name : ' ';
        $last_name = request()->last_name ? request()->last_name : ' ';
        $status = request()->status ? request()->status : ' ';
        $compony_name = request()->compony_name ? request()->compony_name : ' ';
        $industry_number = request()->industry_number ? request()->industry_number : ' ';
        $sage = request()->sage ? request()->sage : ' ';
        $email = request()->email ? request()->email : ' ';
        $password = request()->password ? request()->password : ' ';
        $mobile_number = request()->mobile_number ? request()->mobile_number : ' ';
        $fax_number = request()->fax_number ? request()->fax_number : ' ';
        $landphone_number = request()->landphone_number ? request()->landphone_number : ' ';
        $office_number = request()->office_number ? request()->office_number : ' ';
        $address = request()->address ? request()->address : ' ';
        $city = request()->city ? request()->city : ' ';
        $country = request()->country ? request()->country : ' ';
        $state = request()->state ? request()->state : ' ';
        $zip = request()->zip ? request()->zip : ' ';
        $bill_address1 = request()->bill_address1 ? request()->bill_address1 : ' ';
        $bill_address2 = request()->bill_address2 ? request()->bill_address2 : ' ';
        $bill_city = request()->bill_city ? request()->bill_city : ' ';
        $bill_state = request()->bill_state ? request()->bill_state : ' ';
        $bill_zip = request()->bill_zip ? request()->bill_zip : ' ';
        $shipping_address1 = request()->shipping_address1 ? request()->shipping_address1 : ' ';
        $shipping_address2 = request()->shipping_address2 ? request()->shipping_address2 : ' ';
        $shipping_city = request()->shipping_city ? request()->shipping_city : ' ';
        $shipping_state = request()->shipping_state ? request()->shipping_state : ' ';
        $shipping_zip = request()->shipping_zip ? request()->shipping_zip : ' ';
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'firstname' => $first_name,
            'lastname' => $last_name,
            'status' => $status,
            'company_name' => $compony_name,
            'industry_number' => $industry_number,
            'sage_number' => $sage,
            'email' => $email,
            'password' => $password,
            'mobile_phone' => $mobile_number,
            'fax_number' => $fax_number,
            'land_phone' => $landphone_number,
            'office_number' => $office_number,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'state' => $state,
            'zip' => $zip,
            'bill_address1' => $bill_address1,
            'bill_address2' => $bill_address2,
            'bill_city' => $bill_city,
            'bill_state' => $bill_state,
            'bill_zip' => $bill_zip,
            'shipping_address1' => $shipping_address1,
            'shipping_address2' => $shipping_address2,
            'shipping_city' => $shipping_city,
            'shipping_state' => $shipping_state,
            'shipping_zip' => $shipping_zip,
            'created' => $today
        ];
        return Customer::insert($inputs);
    }

    public function edit_customer($id)
    {
        $customer =  DB::table('customers')->select('*')->where("id", "=", $id)->get();
        $state = State::all();
        $country = Country::all();
        return view('dashboard.edit_customer')->with('result', $customer)->with('state', $state)->with('country', $country);
    }

    public function edit_customer_api()
    {
        $id = request()->id;
        $first_name = request()->first_name ? request()->first_name : ' ';
        $last_name = request()->last_name ? request()->last_name : ' ';
        $status = request()->status ? request()->status : ' ';
        $compony_name = request()->compony_name ? request()->compony_name : ' ';
        $industry_number = request()->industry_number ? request()->industry_number : ' ';
        $sage = request()->sage ? request()->sage : ' ';
        $email = request()->email ? request()->email : ' ';
        $password = request()->password ? request()->password : ' ';
        $mobile_number = request()->mobile_number ? request()->mobile_number : ' ';
        $fax_number = request()->fax_number ? request()->fax_number : ' ';
        $landphone_number = request()->landphone_number ? request()->landphone_number : ' ';
        $office_number = request()->office_number ? request()->office_number : ' ';
        $address = request()->address ? request()->address : ' ';
        $city = request()->city ? request()->city : ' ';
        $country = request()->country ? request()->country : ' ';
        $state = request()->state ? request()->state : ' ';
        $zip = request()->zip ? request()->zip : ' ';
        $bill_address1 = request()->bill_address1 ? request()->bill_address1 : ' ';
        $bill_address2 = request()->bill_address2 ? request()->bill_address2 : ' ';
        $bill_city = request()->bill_city ? request()->bill_city : ' ';
        $bill_state = request()->bill_state ? request()->bill_state : ' ';
        $bill_zip = request()->bill_zip ? request()->bill_zip : ' ';
        $shipping_address1 = request()->shipping_address1 ? request()->shipping_address1 : ' ';
        $shipping_address2 = request()->shipping_address2 ? request()->shipping_address2 : ' ';
        $shipping_city = request()->shipping_city ? request()->shipping_city : ' ';
        $shipping_state = request()->shipping_state ? request()->shipping_state : ' ';
        $shipping_zip = request()->shipping_zip ? request()->shipping_zip : ' ';
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE customers SET firstname = '" . addslashes($first_name) . "', lastname = '" . addslashes($last_name) . "', status = '" . addslashes($status) . "', company_name = '" . addslashes($compony_name) . "', industry_number = '" . addslashes($industry_number) . "', sage_number = '" . addslashes($sage) . "', email = '" . addslashes($email) . "', password = '" . addslashes($password) . "', mobile_phone = '" . addslashes($mobile_number) . "', fax_number = '" . addslashes($fax_number) . "', land_phone = '" . addslashes($landphone_number) . "', office_number = '" . addslashes($office_number) . "', address = '" . addslashes($address) . "', city = '" . addslashes($city) . "', country = '" . addslashes($country) . "', state = '" . addslashes($state) . "', zip = '" . addslashes($zip) . "', bill_address1 = '" . addslashes($bill_address1) . "', bill_address2 = '" . addslashes($bill_address2) . "', bill_city = '" . addslashes($bill_city) . "', bill_state = '" . addslashes($bill_state) . "', bill_zip = '" . addslashes($bill_zip) . "', shipping_address1 = '" . addslashes($shipping_address1) . "', shipping_address2 = '" . addslashes($shipping_address2) . "', shipping_city = '" . addslashes($shipping_city) . "', shipping_zip = '" . addslashes($shipping_zip) . "', shipping_state = '" . addslashes($shipping_state) . "', modified = '" . addslashes($today) . "' where id = {$id}");
    }

    public function del_customer_api()
    {
        $id =  request()->id;
        return DB::table('customers')->where('id', '=', $id)->delete();
    }

    public function detail_customer()
    {
        return view('dashboard.detail_customer');
    }

    public function exportFile()
    {
        return Excel::download(new CustomerExport, 'users-list.xlsx');
    }

    public function show_subscribers()
    {
        $subscribers = Subscriber::all();
        return view('dashboard.subscribers')->with('result', $subscribers);
    }

    public function add_subscribers()
    {
        return view('dashboard.add_subscriber');
    }

    public function add_subscribers_api()
    {
        $inputs = [
            'email_id' => request()->email_id ? request()->email_id : '',
            'created' => date("Y-n-j H:i:s")
        ];
        return Subscriber::insert($inputs);
    }

    public function edit_subscribers($id)
    {
        $subscriber = Subscriber::find($id);
        return view('dashboard.edit_subscriber')->with('subscriber', $subscriber);
    }

    public function edit_subscribers_api()
    {
        $id = request()->id;
        $subscriber = Subscriber::find($id);
        $subscriber->email_id = request()->email_id;
        $subscriber->modified = date("Y-n-j H:i:s");
        $subscriber->save();
        if ($subscriber->wasChanged()) {
            return 1;
        } else {
            return 2;
        }
    }

    public function del_subscribers_api()
    {
        $id =  request()->id;
        $subscriber = Subscriber::find($id);
        return $subscriber->delete();
    }

    public function export_subscriberFile()
    {
        return Excel::download(new SubscriberExport, 'subscribers-list.xlsx');
    }

    public function show_contacts()
    {
        $contacts = Contactus::orderBy('contact_date', 'DESC')->get();
        return view('dashboard.contacts')->with('result', $contacts);
    }

    public function edit_contacts($id)
    {
        $contacts = Contactus::find($id);
        return view('dashboard.edit_contacts')->with('result', $contacts);
    }

    public function export_contactFile()
    {
        return Excel::download(new ContactExport, 'contacts-list.xlsx');
    }

    public function del_contact_api()
    {
        $id =  request()->id;
        $contactus = Contactus::find($id);
        return $contactus->delete();
    }
}
