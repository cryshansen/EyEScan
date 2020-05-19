//
//  Person.h
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-10.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <AddressBook/AddressBook.h>
#import "vCard.h"
@interface Person : NSObject {

    vCard *newPerson;

}

- (id) init;
- (void)createPersonRecord;


@end
