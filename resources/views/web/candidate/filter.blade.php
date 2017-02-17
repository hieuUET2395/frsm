@forelse ($candidates as $candidate)
    <tr>
        <td>{{ $candidate->name }}</td>
        <td>{{ $candidate->email }}</td>
        <td>{{ $candidate->position->name }}</td>
        <td>{{ $candidate->phone }}</td>
        <td>{{ $candidate->cv_file }}</td>
        <td>{{ $candidate->status }}</td>
        <td>
            {{ $candidate->created_at }}
            <a class="btn btn-primary pull-right" href="#">
                @lang('messages.edit')
            </a>
        </td>
    </tr>
@empty
    <tr class="text-center">
        <td colspan="7">@lang('messages.no_result')</td>
    </tr>
@endforelse
<tr class="paginate">
    <td colspan="7">{{ $candidates->links() }}</td>
</tr>
