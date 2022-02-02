<div class="mr-2 mb-2">
    <div class="card" style="width: 18rem;max-height: 23rem;min-height: 23rem;">
        <img class="card-img-top" src="{{ $user->pf() }}" alt="Profile Picture">

        <div class="card-body">
            <h5 class="card-title">{{ $user->fullname() }}</h5>
            <p class="card-text"><span class="text-secondary"> aka </span>{{ $user->username }} <label class="badge badge-secondary" style="background: {{ $user->role->color }}">{{ $user->role->name }}</label></p>

            <a href="/profile/{{ $user->username }}" class="btn btn-primary">View</a>
        </div>
    </div>
</div>
