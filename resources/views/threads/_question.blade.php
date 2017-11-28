<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">
        <div class="level">
            <input type="text" value="{{ $thread->title }}" class="form-control">
        </div>
    </div>

    <div class="panel-body">
        <div class="form-g">
            <textarea row="10" class="form-control">{{ $thread->body }}</textarea>
        </div>
    </div>

    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-xs btn-primary level-item" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-xs btn-primary level-item" @click="editing = false" v-show="editing">Update</button>
            <button class="btn btn-xs btn-default level-item" @click="editing = false">Cancel</button>

            @can('update', $thread)
                <form action="{{ $thread->path() }}" method="POST" class="ml-a">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>

<div class="panel panel-default" v-if="! editing">
    <div class="panel-heading">
        <div class="level">
            <span class="flex">
                <img src="{{ asset($thread->creator->avatar_path) }}" alt="{{ $thread->creator->name }}"
                     width="25" height="25" class="mr-1">
                <a href="{{ route('profile', $thread->creator->name) }}">{{ $thread->creator->name }}</a> posted:
                {{ $thread->title }}
            </span>
        </div>
    </div>

    <div class="panel-body">
        {{ $thread->body }}
    </div>

    <div class="panel-footer">
        <button class="btn btn-xs btn-primary" @click="editing = true">Edit</button>
    </div>
</div>