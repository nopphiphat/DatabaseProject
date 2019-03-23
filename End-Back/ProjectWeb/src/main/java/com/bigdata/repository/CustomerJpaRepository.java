package com.bigdata.repository;

import com.bigdata.hibernate.Customer;
import org.springframework.data.jpa.repository.JpaRepository;

public interface CustomerJpaRepository extends JpaRepository<Customer,Long> {

}
