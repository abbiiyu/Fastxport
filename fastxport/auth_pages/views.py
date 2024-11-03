from django.shortcuts import render

# Create your views here.
def login(request):
    context = {
        'name': 'Halaman Login'
    }
    return render(request, 'login/login.html', context)

def register(request):
    context = {
        'name': 'Halaman Register'
    }
    return render(request, 'register/register.html', context)