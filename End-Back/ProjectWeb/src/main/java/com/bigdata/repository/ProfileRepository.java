package com.bigdata.repository;

import com.bigdata.hibernate.Profile;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.Repository;
import org.springframework.data.repository.query.Param;

import java.util.List;

public interface ProfileRepository extends Repository<Profile,Long> {

    //find by email
    @Query(value = "SELECT * FROM profile WHERE profile.customer_email = :email",nativeQuery = true)
    List<Profile> findProfileByEmail(@Param("email") String email);
}
