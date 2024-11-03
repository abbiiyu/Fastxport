from django.urls import path
from . import views

urlpatterns = [
    path('', views.product, name="product"),
    path('supplier/', views.supplier, name="supplier"),
    path('join-form/', views.joinForm, name="joinform"),
    path('ekspedisi/', views.ekspedisi, name="ekspedisi"),
    path('product-detail/', views.productDetail, name="productDetail"),
    
    

    
]