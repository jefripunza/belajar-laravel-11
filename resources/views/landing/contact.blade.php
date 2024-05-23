<x-layout.landing>
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Welcome to Contact Page</p>
    <table>
        <tr>
            <td>Phone Number</td>
            <td>{{ $info['phone_number'] }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $info['email'] }}</td>
        </tr>
        <tr>
            <td>Instagram</td>
            <td>{{ $info['instagram'] }}</td>
        </tr>
        <tr>
            <td>Linkedin</td>
            <td>{{ $info['linkedin'] }}</td>
        </tr>
    </table>
</x-layout.landing>
