<div class="mt-3">

    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}"
                        alt="{{ $idea->user->name }}">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                                {{ $idea->user->name }}
                            </a></h5>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('ideas.destroy', $idea->id) }}">
                        <a href="{{ route('ideas.show', $idea->id) }}"> View </a>
                        @can('delete', $idea)
                            @method('delete')
                            @csrf
                            @can('update', $idea)
                                <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}"> Edit </a>
                            @endcan

                            <button class="ms-1 btn btn-danger btn-sm">X</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($editting ?? false)
                <form method="POST" action="{{ route('ideas.update', $idea->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <textarea class="form-control" name="content" id="idea" rows="3">{{ $idea->content }}</textarea>
                        @error('idea')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <button class="btn btn-dark mb-2 btn-sm"> Update </button>
                    </div>
                </form>
            @else
                <p class="fs-6 fw-light text-muted">
                    {{ $idea->content }}
                </p>
            @endif
            <div class="d-flex justify-content-between">
                @include('ideas.shared.like-button')
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $idea->created_at->diffForHumans() }} </span>
                </div>
            </div>
            @include('ideas.shared.comments-box')
        </div>
    </div>
</div>
