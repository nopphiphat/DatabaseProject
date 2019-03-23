package com.bigdata.Imps;

import com.bigdata.hibernate.Customer;
import com.bigdata.hibernate.Profile;
import com.bigdata.model.servicemodel.PersonalProfile;
import com.bigdata.repository.CustomerJpaRepository;
import com.bigdata.repository.CustomerRepository;
import com.bigdata.repository.ProfileJpaRepository;
import com.bigdata.repository.ProfileRepository;
import com.bigdata.service.CustomerService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import javax.transaction.Transactional;
import java.util.ArrayList;
import java.util.List;

@Service
@Transactional
public class CustomerServiceImpl implements CustomerService {


    @Autowired
    private CustomerJpaRepository customerJpaRepository;
    @Autowired
    private ProfileJpaRepository profileJpaRepository;

    @Autowired
    private CustomerRepository customerRepository;
    @Autowired
    private ProfileRepository profileRepository;



    @Override
    //Get All Data from customer
    public List<Customer> findAllCustomer() {
        List<Customer> customers = customerJpaRepository.findAll();
        return customers;
    }

    @Override
    public void saveCustomer(Customer customer) {
        customerJpaRepository.save(customer);

    }

    @Override
    public List<Customer> findCustomerByEmail(String email) {
        List<Customer> customers = customerRepository.findCustomerByEmail(email);
        return customers;
    }


    //search the shown profile by email
    @Override
    public PersonalProfile findShowProfileByEmail(String email) {
        List<Customer> customer = customerRepository.findCustomerByEmail(email);
        List<Profile> profile = profileRepository.findProfileByEmail(email);
        PersonalProfile pprofile = new PersonalProfile();

        if(customer.size()<=0||profile.size()<=0){
            return pprofile;
        }else {


            pprofile.setEmail(email);
            pprofile.setDescription(profile.get(0).getDescription());
            pprofile.setFirst_name(customer.get(0).getFirstName());
            pprofile.setImg(profile.get(0).getImg());
            pprofile.setLast_name(customer.get(0).getLastName());
            pprofile.setPosition(profile.get(0).getPostition());

            return pprofile;
        }
    }


}
