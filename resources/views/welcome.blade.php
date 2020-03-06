<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News Application with Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="container-fluid">
        <nav class="navbar  navbar-light bg-faded" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">News Around the World</a>
        </nav>
        <form class="form-inline" action="/" method="get">
            <div class="form-group mb-2 mr-2 mt-2">
                <label for="news_sources" class="col-form-label mr-2">Select a news source:</label>
                <select class="form-control" name="source" id="news_sources">
                    <option value="{{@$source_id}} : {{@$source_name}}">{{$source_name}}</option>
                    @foreach ($news_sources as $news_source)
                        <option
                            value="{{$news_source['id']}} : {{$news_source['name'] }}">{{$news_source['name']}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mb-2 mt-2">Ok</button>
        </form>
    </div>
    <div class="container-fluid">
        <div class="bg-secondary m-1 text-center text-white">
            <h1>Top {{App\Enums\SystemSettingsEnum::ARTICLES_NUMBER}} news - News Source : {{$source_name}}</h1>
        </div>

        <section class="news">
            @foreach($news as $selected_news)

                <div class="card mt-2">
                    <div class="card-header">
                        {{$selected_news['title']}}
                    </div>
                    <div class="card-body">

                        <article class="card">

                            <img src="{{$selected_news['urlToImage']}}" class="card-img-top figure-img"
                                 alt="photo of the article">
                            <div class="card-body">

                                <p class="card-text" style="font-size: 14px">
                                    {{$selected_news['description']}}
                                </p>
                                @isset($selected_news['author'])
                                    <div>
                                        <b>
                                            Author: {{ strip_tags($selected_news['author'])  }}
                                        </b>
                                    </div>
                                @endisset
                                <a target="_blank" href="{{$selected_news['url']}}" class="btn btn-primary">Read more...</a>
                            </div>

                        </article>
                    </div>
                    <div class="card-footer text-muted">

                        @if($selected_news['publishedAt'] != null)
                            <div style="padding-top: 5px;">Date
                                Published: {{ Carbon\Carbon::parse($selected_news['publishedAt'])->format('l jS \\of F Y ') }}</div>
                        @else
                            <div style="padding-top: 5px;">Date Published: Unknown</div>

                        @endif
                    </div>
                </div>

                @if($loop->iteration==App\Enums\SystemSettingsEnum::ARTICLES_NUMBER)
                    @break
                @endif
            @endforeach
        </section>
    </div>

</div>


</body>
</html>
