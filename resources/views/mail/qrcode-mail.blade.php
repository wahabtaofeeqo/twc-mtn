<x-mail::message>
# Hi {{$user->name}}

<div style="margin-bottom: 10px">
    <img src="{{ asset("qrcode/" . $user->email . "/qr_" . $user->code) }}" alt="QR Code">
</div>

<p>
    Your unique Code: <strong>{{$user->code}}</strong>
</p>

</x-mail::message>
