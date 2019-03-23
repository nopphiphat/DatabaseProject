package com.bigdata.repository;

import com.bigdata.hibernate.Profile;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ProfileJpaRepository extends JpaRepository<Profile,Long> {

}
