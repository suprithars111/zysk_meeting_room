@php $editing = isset($userMeetingRoom) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $userMeetingRoom->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="meeting_room_type_id"
            label="Meeting Room Type"
            required
        >
            @php $selected = old('meeting_room_type_id', ($editing ? $userMeetingRoom->meeting_room_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Meeting Room Type</option>
            @foreach($meetingRoomTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.url
            name="url"
            label="Url"
            value="{{ old('url', ($editing ? $userMeetingRoom->url : '')) }}"
            maxlength="255"
            required
        ></x-inputs.url>
    </x-inputs.group>
</div>
