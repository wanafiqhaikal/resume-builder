<!DOCTYPE html>
<html>

<head>
    <title>Edit Resume | Resume Builder</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @include('header')
    <div class="breadcrumb custom-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('resumes.index') }}">Home</a>
        <span class="breadcrumb-item">Edit</span>
    </div>
</head>

<body>

    <br><br>
    <h3 class="container">Edit Resume</h3>

    <form action="{{ route('resumes.update', $resumes->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to update this resume?');">
        @csrf
        @method('PUT')

        <table class="container">
            <tr>
                <th>Username</th>
            </tr>
            <tr>
                <td>{{ $resumes->username }}</td>
            </tr>
        </table>
        <br><br>

        <!-- Education Table -->
        <h3 class="container">Education</h3>
        <table class="container">
            <thead>
                <tr>
                    <td colspan="4">
                        <div class="container">
                            <button type="button" onclick="addEducationRow()" class="btn btn-primary">Add Education</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Institution</th>
                    <th>Degree</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="education_table">
                @foreach ($educations as $index => $education)
                    <input type="hidden" name="deleted_education_ids[]" value="{{ $education->id }}">
                    <tr class="container">
                        <td>
                            <input type="text" name="education[{{ $index }}][id]"
                                value="{{ $education->id ? $education->id : '' }}" readonly>
                        </td>
                        <td>
                            <input type="text" name="education[{{ $index }}][institution]"
                                value="{{ $education->institution }}" required>
                        </td>
                        <td>
                            <input type="text" name="education[{{ $index }}][degree]"
                                value="{{ $education->degree }}" required>
                        </td>
                        <td>
                            <button type="button" onclick="deleteRow(this, 'education')" class="btn btn-danger">Delete</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>

        <!-- Experience Table -->
        <h3 class="container">Experience</h3>
        <table class="container">
            <thead>
                <tr>
                    <td colspan="4">
                        <div>
                            <button type="button" onclick="addExperienceRow()" class="btn btn-primary">Add Experience</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="experience_table">
                @foreach ($experiences as $index => $experience)
                    <input type="hidden" name="deleted_experience_ids[]" value="{{ $experience->id }}">
                    <tr class="container">
                        <td>
                            <input type="text" name="experience[{{ $index }}][id]"
                                value="{{ $experience->id ? $experience->id : '' }}" readonly>
                        </td>
                        <td>
                            <input type="text" name="experience[{{ $index }}][company]"
                                value="{{ $experience->company }}" required>
                        </td>
                        <td>
                            <input type="text" name="experience[{{ $index }}][position]"
                                value="{{ $experience->position }}" required>
                        </td>
                        <td>
                            <button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>

        <div class="container">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('resumes.index') }}"><button type="button" class="btn btn-secondary">Cancel</button></a>
        </div>
        <br>
    </form>

    <script>
        var educationIndex = {{ count($educations) }};
        var experienceIndex = {{ count($experiences) }};

        function addEducationRow() {
            var table = document.getElementById("education_table");
            var row = table.insertRow();
            row.innerHTML = `
                <td></td>
                <td class="container">
                    <input type="text" name="education[${educationIndex}][institution]" required>
                </td>
                <td class="container">
                    <input type="text" name="education[${educationIndex}][degree]" required>
                </td>
                <td class="container">
                    <button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button>
                </td>
            `;
            educationIndex++;
        }

        function addExperienceRow() {
            var table = document.getElementById("experience_table");
            var row = table.insertRow();
            row.innerHTML = `
                <td></td>
                <td class="container">
                    <input type="text" name="experience[${experienceIndex}][company]" required>
                </td>
                <td class="container">
                    <input type="text" name="experience[${experienceIndex}][position]" required>
                </td>
                <td class="container">
                    <button type="button" onclick="deleteRow(this)" class="btn btn-danger">Delete</button>
                </td>
            `;
            experienceIndex++;
        }

        function deleteRow(button, type) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

            if (type === 'education') {
                const educationId = row.querySelector('[name^="education["][name$="][id]"]').value;
                deletedEducationIds.push(educationId);
            } else if (type === 'experience') {
                const experienceId = row.querySelector('[name^="experience["][name$="][id]"]').value;
                deletedExperienceIds.push(experienceId);
            }
        }
    </script>

</body>
@include('footer')

</html>
