from django.urls import path
from . import views

urlpatterns = [
    path('', views.product, name="product"),
    path('supplier/', views.supplier, name="supplier"),
    path('join-form/', views.joinForm, name="joinform"),

    
]