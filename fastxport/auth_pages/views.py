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

def signsucces(request):
    context = {
        'name': 'Halaman SignSuccess'
    }
    return render(request, 'register/signsucces.html', context)