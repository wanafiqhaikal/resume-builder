<!DOCTYPE html>
<html>

<head>
    <title>List of Resume | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
    <div class="breadcrumb custom-breadcrumb">
        <a class="breadcrumb-item">Home</a>
    </div>
</head>

<body>
    {{-- <h4>Resume > List</h4> --}}

    @if (session('success'))
        <div class="container">{{ session('success') }}</div>
    @endif

    <br><br>

    <div class="container">
        <a href="{{ route('resumes.create') }}"><button type="button" class="btn btn-primary">Add New</button></a>
    </div>
    <br><br>


    <table>
        <thead>
            <tr class="container">
                <th>View</th>
                <th>Edit</th>
                <th>ID</th>
                <th>Username</th>
                <th>Delete</th>
            </tr>
        </thead>
        @if ($resumes->isEmpty())
            <tbody>
                <tr>
                    <td colspan="9" align="center">No Data Available
                    </td>
                </tr>
            </tbody>
        @else
            <tbody>
                @foreach ($resumes as $resume)
                    <tr class="container">
                        <td>
                            <a href="{{ route('resumes.show', $resume->username) }}"><button
                                    type="button" class="btn btn-dark">View</button></a>
                        </td>
                        <td>
                            <a href="{{ route('resumes.edit', $resume->username) }}"><button
                                    type="button" class="btn btn-info">Edit</button></a>
                        </td>
                        <td>{{ $resume->id }}</td>
                        <td>{{ $resume->username }}</td>
                        <td>
                            <form action="{{ route('resumes.destroy', $resume->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this resume?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Delete Resume">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
</body>
@include('footer')

</html>
