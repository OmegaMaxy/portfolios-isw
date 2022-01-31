<div class="mr-2 mb-2">
    <div class="card" style="width: 18rem;">
        @if (!empty($user->profile_picture))
        <img class="card-img-top" src="{{ $user->pf() }}" alt="Profile Picture">
        @else
            <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUHNoKb6n8cRAjyputJ9vn4OPdujzLJr52OQ&usqp=CAU" alt="Profile Picture">
        @endif

        <div class="card-body">
            <h5 class="card-title">{{ $user->fullname() }}</h5>
            <p class="card-text"><span class="text-secondary"> aka </span>{{ $user->username }} <label class="badge badge-primary">{{ $user->role->name }}</label></p>

            <a href="/profile/{{ $user->username }}" class="btn btn-primary">View</a>
        </div>
    </div>
</div>
