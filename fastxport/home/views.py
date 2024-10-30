from django.shortcuts import render

# Create your views here.
def home(request):
    context = {
        'name': 'Halaman Home'
    }
    return render(request, 'home/index.html', context)