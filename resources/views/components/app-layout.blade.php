@props(['link' => null])
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @auth
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-sm">
        <div class="navbar-start"></div>

        <div class="navbar-end gap-4">
            @if (request()->routeIs('user.links'))

            @if(isset($link) && $link->status === \App\Enums\LinkStatus::Active)

            <form method="POST" action="{{route('user.link.deactivate')}}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Deactivate link</button>
            </form>
            @endif

            <form method="POST" action="{{route('user.link.regenerate')}}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Regenerate link</button>
            </form>

            @endif

            @if (request()->routeIs('user.lottery.show') || request()->routeIs('user.lottery.results'))
                    <a href="{{route('user.links')}}" class="btn">Back to Link</a>
            @endif
            <a href="/logout" class="btn">Logout</a>
        </div>

    </div>
    <!-- /Navbar -->
    @endauth
    <main>
        {{ $slot ?? ''}}
    </main>
</div>
</body>
</html>
