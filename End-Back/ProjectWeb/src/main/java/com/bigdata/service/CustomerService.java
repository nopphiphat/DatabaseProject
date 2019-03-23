package com.bigdata.service;

import com.bigdata.hibernate.Customer;
import com.bigdata.hibernate.Profile;
import com.bigdata.model.servicemodel.PersonalProfile;

import java.util.List;

public interface CustomerService {

    //original function
    List<Customer> findAllCustomer();


    //save customer
    void saveCustomer(Customer customer);

    List<Customer> findCustomerByEmail(String email);

    PersonalProfile findShowProfileByEmail(String email);

}
