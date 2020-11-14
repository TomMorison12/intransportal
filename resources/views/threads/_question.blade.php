<div class="card" v-if=editing>
                    <div class="card-header">

                            <input class="form-control" type="text" class="flex" name="title" v-model="form.title" />
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <textarea rows="20" cols="20" class="form-control" v-model="form.body"></textarea>
                         </div>
                    </div>
                    <div class="card-footer">
                    <div class="level">
                        <button class="btn btn-xs level-item" @click="update">Update</button>
                        <button class="btn btn-xs level-item" @click="editing = false">Cancel</button>


                    @can('update', $thread)
                            <form action="{{$thread->path()}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                        @endcan
                        </div>
                    </div>
                </div>

<div class="card" v-if=!editing>
                    <div class="card-header">
                        <div class="level flex">
                            @if($thread->creator->avatar_path)
                            <img src="{{asset('/storage/'.$thread->creator->avatar_path)}}" width="25" height="25" class="mr-1" />
                            @endif
                            <span class="flex"><a href="{{route('profile', $thread->creator->name)}}">{{ $thread->creator->name}}</a> posted <span v-text="form.title"></span></span>

                        </div>
                    </div>
                    <div class="card-body" v-text="form.body">
                    </div>
                    <div class="card-footer">
                    <div class="level">

                    <button class="btn btn-xs level-item" @click="editing = true" v-show="!editing">Edit</button>
                    @can('update', $thread)
                            <form action="{{$thread->path()}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                        @endcan
                        </div>

                    </div>
                </div>
