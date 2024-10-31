from django.shortcuts import render

# Create your views here.
def product(request):
    context = {
        'name': 'Halaman Product'
    }
    return render(request, 'product/product.html', context)

def supplier(request):
    context = {
        'name': 'Halaman Product'
    }
    return render(request, 'product/supplier.html', context)

def joinForm(request):
    context = {
        'name': 'Halaman Product'
    }
    return render(request, 'product/joinform.html', context)
