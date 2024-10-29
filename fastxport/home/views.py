from django.shortcuts import render

# Create your views here.
def home(request):
    context = {
        'name': 'Blog saya'
    }
    return render(request, 'home/index.html', context)