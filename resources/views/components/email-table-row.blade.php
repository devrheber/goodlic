@isset($type)
@if ($type == 'p')
    <tr>
        <th align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-right: 0px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838;">
            {{ $heading }}:

        </th>
        <td align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-left: 0px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838; font-size: 14px;">
            {{ $record }}

        </td>
    </tr>
@elseif($type == 'link')
    <tr>
        <th align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-right: 0px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838;">
            {{ $heading }}:

        </th>
        <td align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-left: 0px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838; font-size: 14px;">
            <a target="_blank" class="Button-primary"
                style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: 'Copyright Klim Type Foundry'; border-radius: 0px; color: rgb(30, 132, 204); display: block; font-size: 14px; font-weight: 400;  text-decoration: none;"
                href="{{ $record }}">
                View
            </a>

        </td>
    </tr>
@else
    <tr>
        <th align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-right: 0px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838; font-weight: 500; font-size: 14px; margin-left: 15px;">
            {{ $heading }}:

        </th>
        <td align="left" valign="center"
            style="border: 1px solid #DEE2E6; border-left: 0px; width: 350px; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 16px; color: #383838;  margin-right: 20px;">
            {{ $record }}
        </td>
    </tr>
@endif
@endisset
