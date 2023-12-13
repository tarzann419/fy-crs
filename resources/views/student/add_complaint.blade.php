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

                <div class="py-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @foreach(Session::get('images') as $image)
                    <img src="images/{{ $image['name'] }}" width="300px">
                    @endforeach
                    @endif
                    <!--  form -->
                    <form action="{{ route('store.complaint') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-4">
                            <label for="complaint_type" class="block text-gray-600">Complaint Type:</label>
                            <select id="complaint_type" name="category_id" class="form-select mt-1 block w-full @error('category_id') is-invalid @enderror">
                                <option value="" disabled selected>Select a type</option>
                                @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-600">Description:</label>
                            <textarea id="description" name="description" class="form-textarea mt-1 block w-full @error('description') is-invalid @enderror" rows="4"></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label for="datetime" class="block text-gray-600">Date of Occurrence:</label>
                            <input type="date" id="datetime" name="date_of_occurence" class="form-input mt-1 block w-full @error('date_of_occurence') is-invalid @enderror" data-input>
                            @error('date_of_occurence')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- <div class="mb-4">
                        <label for="image" class="block text-gray-600">Upload Image:</label>
                        <input type="file" id="image" name="attachments" accept="image/*" class="form-input mt-1 block w-full">
                    </div> -->

                        <div class="mb-3">
                            <label class="form-label" for="inputImage">Select Images:</label>
                            <input type="file" name="attachments[]" id="inputImage" multiple class="form-control @error('images') is-invalid @enderror">

                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>




                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                    </form>
                    <!-- End of your form -->
                </div>
            </div>
        </div>
    </x-app-layout>
</body>