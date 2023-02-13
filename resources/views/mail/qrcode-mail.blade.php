<x-mail::message>
# Y'ello {{$user->firstname}}!

The 2023 S&D Sales Conference is Here!!!

The Sales Conference is an annual event that brings together the staff and partners of Sales & Distribution unit. It comes with lots of inspiring, intellectual, fun-filled and memorable programs to energize the team and set the tone for the new year.

This year’s conference theme is L.E.A.D – Lead. Evolve. Attain. Dominate. which ties succinctly with our collective zest to meet and surpass our business expectations in 2023.

It kicks off on the 15th February with the Staff and Partners’ meetings, and wraps up on the 16th February with a Gala and Awards night.

Kindly refer to the Joining Instructions sent to you for further details

Also find below your unique QR Code and ID to give you access to all the event

Your QRcode:
<div style="margin-bottom: 10px">
    <img src="{{ asset("qrcode/" . $user->email . "/" . $qrCode) }}" alt="QR Code">
</div>

<p>
    Your unique Code: <strong>{{$user->code}}</strong>
</p>

See you there!

Sales Conference Planning Committee

</x-mail::message>
