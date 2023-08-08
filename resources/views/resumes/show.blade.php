<!DOCTYPE html>
<html>

<head>
    <title>Resume Details | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
    <div class="breadcrumb custom-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('resumes.index') }}">Home</a>
        <span class="breadcrumb-item">View</span>
    </div>
</head>

<body>

    <br><br>
    <h3 class="container"><strong>RESUME</strong></h3>

    <table border="1" class="container">
        <thead>
            <tr>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $resumes->username }}</td>
            </tr>
        </tbody>
    </table>
    <br><br>

    <!-- Display Education Table -->
    <h3 class="container">Education</h3>
    <table border="1" class="container">
        <thead>
            <tr>
                <th>#</th>
                <th>Institution</th>
                <th>Degree</th>
            </tr>
        </thead>
        @if ($educations->isEmpty())
            <tbody>
                <tr>
                    <td colspan="3" align="center">No Data Available
                    </td>
                </tr>
            </tbody>
        @else
        <tbody>
            @foreach($educations as $key => $education)
            <tr>
                <td>{{ $key + 1}}</td>
                <td>{{ $education->institution }}</td>
                <td>{{ $education->degree }}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    <br><br>

    <!-- Display Experience Table -->
    <h3 class="container">Experience</h3>
    <table border="1" class="container">
        <thead>
            <tr>
                <th>#</th>
                <th>Company</th>
                <th>Position</th>
            </tr>
        </thead>
        @if ($experiences->isEmpty())
            <tbody>
                <tr>
                    <td colspan="3" align="center">No Data Available
                    </td>
                </tr>
            </tbody>
        @else
        <tbody>
            @foreach($experiences as $key => $experience)
            <tr>
                <td>{{ $key + 1}}</td>
                <td>{{ $experience->company }}</td>
                <td>{{ $experience->position }}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    <br><br>

    <div class="container">
        <a href="{{ route('resumes.index') }}"><button type="button" class="btn btn-secondary">Back to List</button></a>
    </div>
</body>
@include('footer')

</html>
