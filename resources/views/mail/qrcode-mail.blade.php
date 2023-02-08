<x-mail::message>
# Hi {{$user->name}}

<div>
    <img src="{{asset('assets/images/banner.jpeg')}}" alt="">
</div>

Your QRcode:
<div style="margin-bottom: 10px">
    <img src="{{ asset("qrcode/" . $user->email . "/" . $qrCode) }}" alt="QR Code">
</div>

<p>
    Your unique Code: <strong>{{$user->code}}</strong>
</p>

</x-mail::message>
