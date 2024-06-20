<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commentaires</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Liste des Commentaires</h1>

        @if ($comments->isEmpty())
            <p class="text-gray-600">Il n'y a pas encore de commentaires.</p>
        @else
            <ul class="bg-white shadow-md rounded-lg p-6">
                @foreach ($comments as $comment)
                    <li class="border-b border-gray-200 py-4 flex items-center">
                        @if ($comment->user && $comment->user->photo)
                            <img src="{{ asset('storage/photos/' . $comment->user->photo) }}" alt="Photo de {{ $comment->user->name }}" class="w-12 h-12 rounded-full mr-4">
                        @else
                            <div class="w-12 h-12 bg-gray-300 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-gray-500">{{ substr($comment->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="text-xl font-semibold">{{ $comment->user ? $comment->user->name : 'Utilisateur inconnu' }}</div>
                            <div class="text-gray-600">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                            <p class="mt-2">{{ $comment->comment_text }}</p>
                        </div>
                        @if (Auth::user()->id == $comment->user_id || Auth::user()->role == 'admin')
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
