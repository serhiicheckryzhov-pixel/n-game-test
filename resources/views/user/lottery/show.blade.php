<x-app-layout>
    <div class="flex flex-col items-center justify-center overflow-y-auto overflow-x-auto">
        <div class="flex items-center gap-2 m-5">
            @if (isset($userLink))
            <form method="POST" action="{{route('user.lottery.play', ['token' => $token])}}">
            @csrf
                <button type="submit" class="btn btn-primary">Imfeelinglucky</button>
            </form>
            @endif

            <form method="GET" action="{{route('user.lottery.results', ['token' => $token])}}">
                <button type="submit" class="btn btn-primary">History</button>
            </form>

        </div>

        @if(session()->has('lottery_result.income'))
            @if (session('lottery_result.income') > 0)
            <div class="badge badge-success m-5">
                You are a winner. Your income is : <b>{{ session('lottery_result.income') }}</b>
            </div>
            @else
                <div class="badge badge-error m-5">Sorry, please try one more time</div>
            @endif
        @endif
    </div>

</x-app-layout>
