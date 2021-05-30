@extends('emails.master')

@section('content')

    <table border="0" cellpadding="0" cellspacing="0" class="bg-light" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box; text-align: right">
        <tbody>
        <tr>
            <td align="right" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                    <tbody>
                    @foreach($buildings as $building)
                        <tr>
                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #FFFFFF; border-radius: 5px; text-align: right; padding: 5px;">
                                <span style="color: green;">{{ $building->number }} {{ $building->name }}</span> ({{ $building->periodArabic()  }})<br>
                                <small style="color: red;">انتهاء التشيك : {{ \Carbon\Carbon::now()->format('Y-m-d') }}</small><br>
                                <span style="color: #1d68a7">مفتش السلامة : {{ $building->user->name }}</span>
                                <hr>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

@endsection
