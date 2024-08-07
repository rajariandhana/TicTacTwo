<x-app-layout>


<div class="relative overflow-x-auto">
    <span class="">total users : {{count($users)}}</span>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User Code
                </th>
                <th scope="col" class="px-6 py-3">
                    created_at
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$user->id}}
                </th>
                <td class="px-6 py-4">
                    {{$user->created_at}}
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>

</x-app-layout>
