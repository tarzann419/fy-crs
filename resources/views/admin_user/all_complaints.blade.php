@include('body.header')

<body>

    <x-app-layout>
        <!-- Sidebar -->
        <div class="flex">
            @include('body.sidebar')

            <!-- Main content area -->
            <div class="w-3/4 p-4">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Hi..{{ Auth::user()->name }}
                    </h2>
                </x-slot>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="py-12">
                    @if(count($complaints) > 0)
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Image</th>
                                <th class="py-2 px-4 border-b">Category</th>
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b">Date Of Occurrence</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $key => $item)
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    @if($item->image)
                                    <img src="{{ $item->image }}" alt="Complaint Image" class="max-w-full h-auto">
                                    @else
                                    <span>No Image</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">{{ $item->category->name }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="badge bg-primary">{{ $item->status }}</span>
                                </td>
                                <td class="py-2 px-4 border-b">{{ $item->date_of_occurence }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="#" class="btn btn-primary btn-lg hover:underline" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</a>
                                    <a href="{{ route('delete.complaint', $item->id) }}" class="btn btn-danger btn-lg hover:underline">Delete</a>
                                </td>

                                <!-- Modal for Edit -->
                                {{--<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Complaint</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('update.complaint', $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="editedField" class="form-label">Description:</label>
                                                        <input type="text" class="form-control" id="editedField" name="description" value="{{ $item->description }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="complaint_type" class="form-label">Complaint Type:</label>
                                                        <select id="complaint_type" name="category_id" class="form-select">
                                                            <option value="" disabled>Select a type</option>
                                                            @foreach ($category as $categoryItem)
                                                            <option value="{{ $categoryItem->id }}" {{ $categoryItem->id == $item->category_id ? 'selected' : '' }}>{{ $categoryItem->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}

                                <!-- End of Modal for Edit -->

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-center text-gray-500 py-4">No data available</p>
                    @endif
                </div>
            </div>
            <!-- end of main area -->
        </div>
    </x-app-layout>

</body>