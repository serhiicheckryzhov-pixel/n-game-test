<x-app-layout :link="$link">
    <div class="flex flex-col items-center justify-center overflow-y-auto overflow-x-auto">
        <p class="m-5">

            Link is:&nbsp;
            @if($link->status === \App\Enums\LinkStatus::Active)
                <a href="/user/lottery/{{$link->token}}" class="link link-info">{{$link->token}}</a>
            @else
                <b>{{$link->token}}</b>
            @endif
        </p>
        @if($link->status === \App\Enums\LinkStatus::Active)
            <div class="badge badge-primary m-5">Expires at: {{$link->expires_at}}</div>
        @else
            <div class="badge badge-error m-5">Link is Inactive</div>
        @endif
    </div>
</x-app-layout>
