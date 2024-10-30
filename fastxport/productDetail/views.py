from django.shortcuts import render

# Create your views here.
def product(request):
    context = {
        'name': 'Halaman ProductDetail'
    }
    return render(request, 'productDetail/productDetail.html', context)